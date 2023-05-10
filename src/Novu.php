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
        Actions\ManagesInboundParse,
        Actions\ManagesNotifications,
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
    protected $baseUri = 'https://api.novu.co/v1/';

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
     * @param  string|null  $apiKey
     * @param  \GuzzleHttp\Client|null  $guzzle
     * @return void
     */
    public function __construct($apiKey = null, HttpClient $client = null)
    {
        if ( is_null($apiKey)) {
            throw IsNull::make('API KEY');
        }

        if( empty($apiKey)) {
            throw isEmpty::make('API KEY');
        }

        if (! is_null($apiKey)) {
            $this->setApiKey($apiKey, $client);
        }

        if (! is_null($client)) {
            $this->client = $client;
        }
    }

    /**
     * Set the api key and setup the client request object.
     *
     * @param  string  $apiKey
     * @param  \GuzzleHttp\Client|null  $client
     * @return $this
     */
    public function setApiKey($apiKey, $client = null)
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
    public function setTimeout($timeout)
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