<?php

namespace Novu\SDK;

use GuzzleHttp\Client as HttpClient;
use Novu\SDK\Exceptions\IsNull;
use Novu\SDK\Exceptions\IsEmpty;

class Novu
{
    use MakeHttpRequests,
        Actions\ManagesTopics,
        Actions\ManagesSubscribers,
        Actions\ManagesActivity,
        Actions\ManagesChanges,
        Actions\ManagesEnvironments,
        Actions\ManagesExecutionDetails,
        Actions\ManagesFeeds,
        Actions\ManagesIntegrations,
        Actions\ManagesMessages,
        Actions\ManagesTriggers,
        Actions\ManagesNotificationGroups,
        Actions\ManagesNotificationTemplates;

 

    /**
     * Create a new Novu instance.
     *
     * @param  string|null  $apiKey
     * @param  \GuzzleHttp\Client|null  $guzzle
     * @return void
     */
    public function __construct(
    /**
         * The Novu API Key.
         *
         * @var string
         */
        protected string $apiKey,

        /**
         * The Novu API Base URL.
         *
         * @var string
         */
        protected string $baseUri = 'https://api.novu.co/v1/',

        /**
         * The Guzzle HTTP Client instance.
         *
         * @var \GuzzleHttp\Client
         */
        public ?\GuzzleHttp\Client $client = null,

        /**
         * Number of seconds a request is retried.
         *
         * @var int
         */
        public int $timeout = 30,

    )
    {

        if( empty($apiKey)) {
            throw isEmpty::make('API KEY');
        }

        $this->setApiKey($apiKey, $client);
        $this->client = $client;
    }

    /**
     * Set the api key and setup the client request object.
     *
     * @param  string  $apiKey
     * @param  \GuzzleHttp\Client|null  $client
     * @return $this
     */
    public function setApiKey($apiKey, $client = null): self
    {
        $this->apiKey = $apiKey;

        $this->client = $client ?: new HttpClient([
            'base_uri' => $this->baseUri,
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'ApiKey '.$this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        return $this;
    }

    /**
     * Set a new timeout.
     *
     * @param  int  $timeout
     * @return $this
     */
    public function setTimeout($timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get the timeout.
     *
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * Get the API Base Uri
     *
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }
}