<?php

namespace Novu\SDK;

use GuzzleHttp\Client as HttpClient;

class Novu
{
    use MakeHttpRequests;

    /**
     * The Nova API Key.
     *
     * @var string
     */
    protected $apiKey;

     /**
     * The Nova API Base URL.
     *
     * @var string
     */
    protected $baseUri = 'https://api.novu.co/v1/';

    /**
     * The Guzzle HTTP Client instance.
     *
     * @var \GuzzleHttp\Client
     */
    public $guzzle;

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
    public function __construct($apiKey = null, HttpClient $guzzle = null)
    {
        if (! is_null($apiKey)) {
            $this->setApiKey($apiKey, $guzzle);
        }

        if (! is_null($guzzle)) {
            $this->guzzle = $guzzle;
        }
    }

    /**
     * Transform the items of the collection to the given class.
     *
     * @param  array  $collection
     * @param  string $class
     * @param  array  $extraData
     * @return array
     */
    protected function transformCollection($collection, $class, $extraData = [])
    {
        return array_map(function ($data) use ($class, $extraData) {
            return new $class($data + $extraData, $this);
        }, $collection);
    }

    /**
     * Set the api key and setup the guzzle request object.
     *
     * @param  string  $apiKey
     * @param  \GuzzleHttp\Client|null  $guzzle
     * @return $this
     */
    public function setApiKey($apiKey, $guzzle = null)
    {
        $this->apiKey = $apiKey;

        $this->guzzle = $guzzle ?: new HttpClient([
            'base_uri' => $this->baseUri,
            'http_errors' => false,
            'headers' => [
                'Authorization' => 'Bearer '.$this->apiKey,
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