<?php

namespace Novu\SDK;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use InvalidArgumentException;
use Novu\SDK\Exceptions\IsNull;
use Novu\SDK\Exceptions\IsEmpty;
use Novu\SDK\ValueObjects\RetryConfig;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\Uuid;

class Novu
{
    use MakeHttpRequests,
        Actions\ManagesTopics,
        Actions\ManagesSubscribers,
        Actions\ManagesActivity,
        Actions\ManagesInboundParse,
        Actions\ManagesNotifications,
        Actions\ManagesChanges,
        Actions\ManagesEnvironments,
        Actions\ManagesExecutionDetails,
        Actions\ManagesFeeds,
        Actions\ManagesIntegrations,
        Actions\ManagesLayout,
        Actions\ManagesMessages,
        Actions\ManagesTenants,
        Actions\ManagesTriggers,
        Actions\ManagesNotificationGroups,
        Actions\ManagesNotificationTemplates,
        Actions\ManagesBlueprints;

    /**
     * The Novu API Key.
     *
     * @var string
     */
    protected $apiKey;

     /**
     * The Novu API Base URL.
     *
     * @var string
     */
    protected $baseUri;

    /**
     * The middleware callable that will handle requests.
     *
     * @var array
     */
    protected $middleware;

    /**
     * The Novu Retry Config.
     *
     * @var RetryConfig
     */
    protected $retryConfig;

    /**
     * The Guzzle HTTP Client instance.
     *
     * @var \GuzzleHttp\Client
     */
    public $client;

    /**
     * Number of seconds a request is retried.
     *
     * @var int
     */
    public $timeout = 30;

    /**
     * Create a new Novu instance.
     *
     * @param array|string|null $config
     * @param \GuzzleHttp\Client|null $client
     * @param RetryConfig|null $retryConfig
     * @return void
     * @throws IsEmpty
     * @throws IsNull
     * @throws InvalidArgumentException
     */
    public function __construct($config = [], HttpClient $client = null, $retryConfig = null)
    {
        // Default values
        $defaultBaseUri = 'https://api.novu.co/v1/';

        if (is_string($config)) {
            $apiKey = $config;
            $baseUri = $defaultBaseUri;
        } elseif (is_array($config)) {
            $apiKey = $config['apiKey'] ?? null;
            $baseUri = $config['baseUri'] ?? $defaultBaseUri;
        } else {
            throw new InvalidArgumentException("Invalid configuration provided.");
        }

        if (is_null($apiKey)) {
            throw IsNull::make('API KEY');
        }

        if (empty($apiKey)) {
            throw IsEmpty::make('API KEY');
        }

        if (is_array($config) && ! empty($timeout = $config['timeout']) && is_int($timeout)) {
            $this->setTimeout($timeout);
        }

        $this->setRetryConfig($config['retryConfig'] ?? $retryConfig);

        $this->baseUri = $baseUri;
        $this->setApiKey($apiKey)->createClient($client);
    }

    /**
     * Set the retry configuration.
     *
     * @param RetryConfig|null $config
     * @return $this
     */
    protected function setRetryConfig($config)
    {
        if ($config instanceof RetryConfig) {
            $this->retryConfig = $config;
        }

        return $this;
    }


    /**
     * Set the api key.
     *
     * @param  string  $apiKey
     * @return $this
     */
    public function setApiKey(string $apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }


    /**
     * Create new Guzzle client.
     *
     * @param  \GuzzleHttp\Client|null $client
     * @return \GuzzleHttp\Client
     */
    protected function createClient($client)
    {
        return $this->client = $client ?: new HttpClient([
            'base_uri' => $this->baseUri,
            'http_errors' => false,
            'cookies' => true,
            'handler' => $this->buildHandlerStack(),
            'headers' => [
                'Authorization' => 'ApiKey '.$this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * Retrieve a reusable Guzzle client.
     *
     * @return \GuzzleHttp\Client
     */
    protected function getReusableClient()
    {
        return $this->client = $this->client ?: $this->createClient(null);
    }

    /**
     * Build the Guzzle client.
     *
     * @return \GuzzleHttp\Client
     */
    public function buildClient()
    {
        return $this->client ?? $this->createClient(null);
    }

    /**
     * Build the Guzzle client handler stack.
     *
     * @return \GuzzleHttp\HandlerStack
     */
    protected function buildHandlerStack()
    {
        return $this->pushHandlers(HandlerStack::create());
    }

    /**
     * Add the necessary handlers to the given handler stack.
     *
     * @param  \GuzzleHttp\HandlerStack $handlerStack
     * @return \GuzzleHttp\HandlerStack
     */
    protected function pushHandlers($handlerStack)
    {
        foreach ($this->middleware as $middleware) {
            $handlerStack->push($middleware);
        }

        return $handlerStack;
    }

    /**
     * Add idempotency request middleware to the client handler stack.
     *
     * @return void
     */
    protected function withIdempotencyMiddleware()
    {
        $this->withRequestMiddleware(function (RequestInterface $request, array $config) {
            if ($request->hasHeader('Idempotency-Key')) {
                return;
            }

            if (! empty($request->getHeaders()) && in_array($request->getMethod(), ['POST', 'PATCH'])) {
                return $request->withHeader('Idempotency-Key', Uuid::uuid4()->toString());
            }
        });
    }

    /**
     * Add new request middleware the client handler stack.
     *
     * @param  callable $middleware
     * @return $this
     */
    public function withRequestMiddleware(callable $middleware)
    {
        array_merge($this->middleware, [Middleware::mapRequest($middleware)]);

        return $this;
    }

    /**
     * Set a new timeout.
     *
     * @param int $timeout
     * @return $this
     */
    public function setTimeout(int $timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get the timeout.
     *
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }
}
