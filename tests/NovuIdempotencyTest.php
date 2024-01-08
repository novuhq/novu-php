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

test('Novu - Retries with the same idempotency key', function () {
    $idempotencyKeys = [];
    $recordedRequests = [];

    $idempotencyKey = Uuid::uuid4()->toString();

    $handlerStack = HandlerStack::create(
        $mock = new MockHandler([
            function (Request $request) use ($idempotencyKey) {
                expect($request->getMethod())->toBe('POST');
                expect($request->hasHeader('Idempotency-Key'))->toBeTruthy();
                expect($request->getHeader('Idempotency-Key')[0])->toEqual($idempotencyKey);

                return new Response(500, [], json_encode(['message' => 'Server Exception']));
            },
            new Response(500, [], json_encode(['message' => 'Server Exception'])),
            new Response(201, [], json_encode(['acknowledged' => true, 'transactionId' => '1003'])),
        ])
    );

    $handlerStack->push(
        Middleware::mapRequest(function (RequestInterface $request) use (&$idempotencyKeys, $idempotencyKey, &$recordedRequests) {
            if (! empty($request->getHeaders()) && in_array($request->getMethod(), ['POST', 'PATCH'])) {
                $idempotencyKeys[] = $idempotencyKey;
                $request           = $request->withAddedHeader('Idempotency-Key', $idempotencyKey);
            }

            $recordedRequests[] = $request;

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

    expect(count($idempotencyKeys))->toBe(3);
    expect(count($recordedRequests))->toBe(3);

    // Verify that the 'Idempotency-Key' header was set to the expected value in all recorded requests
    foreach ($recordedRequests as $request) {
        expect($request->hasHeader('Idempotency-Key'))->toBeTruthy();
        expect($request->getHeader('Idempotency-Key')[0])->toEqual($idempotencyKey);
    }

    $mock->reset();
});
