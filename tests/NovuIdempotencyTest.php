<?php

declare(strict_types=1);

namespace Novu\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Novu\SDK\Novu;
use Novu\SDK\ValueObjects\RetryConfig;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\Uuid;

test('Novu - Retries and idempotency key', function () {
    $idempotencyKeys = [];

    $handlerStack = HandlerStack::create(
        $mock = new MockHandler([
            function (Request $request) {
                $this->assertEquals($request->getMethod(), 'POST');
                $this->assertTrue($request->hasHeader('Idempotency-Key'));

                return new Response(500, [], json_encode(['message' => 'Server Exception']));
            },
            new Response(500, [], json_encode(['message' => 'Server Exception'])),
//            new Response(500, [], json_encode(['message' => 'Server Exception'])),
            new Response(201, [], json_encode(['acknowledged' => true, 'transactionId' => '1003'])),
        ])
    );

    $handlerStack->push(
        Middleware::mapRequest(function (RequestInterface $request) use (&$idempotencyKeys) {
            if ($request->hasHeader('Idempotency-Key')) {
                $idempotencyKeys[] = $key = $request->getHeader('Idempotency-Key');
                $request           = $request->withAddedHeader('Idempotency-Key', $key);
            }

            if (! empty($request->getHeaders()) && in_array($request->getMethod(), ['POST', 'PATCH'])) {
                $idempotencyKeys[] = $uuid = Uuid::uuid4()->toString();
                $request           = $request->withAddedHeader('Idempotency-Key', $uuid);
            }

            return $request;
        })
    );

    $client = new Client(['handler'  => $handlerStack]);

    $novu = new Novu([
        'apiKey' => 'fake-api-key',
    ], $client, new RetryConfig(
        null,
        1,
        1,
        3,
        null
    ));

    $novu->post('events/trigger', [
        'to'      => ['subscriberId' => '123'],
        'payload' => [],
    ]);

//    dd($idempotencyKeys);
});
