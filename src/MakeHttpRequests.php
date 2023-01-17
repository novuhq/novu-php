<?php

namespace Novu\SDK;

use Exception;
use Novu\SDK\Exceptions\FailedAction;
use Novu\SDK\Exceptions\NotFound;
use Novu\SDK\Exceptions\RateLimitExceeded;
use Novu\SDK\Exceptions\Timeout;
use Novu\SDK\Exceptions\ValidationFailed;
use Psr\Http\Message\ResponseInterface;

trait MakeHttpRequests
{
    /**
     * Make a GET request to Novu servers and return the response.
     *
     * @param  string  $uri
     * @return mixed
     */
    public function get($uri)
    {
        return $this->request('GET', $uri);
    }

    /**
     * Make a POST request to Novu servers and return the response.
     *
     * @param  string  $uri
     * @param  array  $payload
     * @return mixed
     */
    public function post($uri, array $payload = [])
    {
        return $this->request('POST', $uri, $payload);
    }

    /**
     * Make a PUT request to Novu servers and return the response.
     *
     * @param  string  $uri
     * @param  array  $payload
     * @return mixed
     */
    public function put($uri, array $payload = [])
    {
        return $this->request('PUT', $uri, $payload);
    }

    /**
     * Make a PATCH request to Novu servers and return the response.
     *
     * @param  string  $uri
     * @param  array  $payload
     * @return mixed
     */
    public function patch($uri, array $payload = [])
    {
        return $this->request('PATCH', $uri, $payload);
    }

    /**
     * Make a DELETE request to Novu servers and return the response.
     *
     * @param  string  $uri
     * @param  array  $payload
     * @return mixed
     */
    public function delete($uri, array $payload = [])
    {
        return $this->request('DELETE', $uri, $payload);
    }

    /**
     * Make request to Novu servers and return the response.
     *
     * @param  string  $verb
     * @param  string  $uri
     * @param  array  $payload
     * @return mixed
     */
    protected function request($verb, $uri, array $payload = [])
    {
        if (isset($payload['json'])) {
            $payload = ['json' => $payload['json']];
        } else {
            $payload = empty($payload) ? [] : ['form_params' => $payload];
        }

        $response = $this->client->request($verb, $uri, $payload);

        $statusCode = $response->getStatusCode();

        if ($statusCode < 200 || $statusCode > 299) {
            return $this->handleRequestError($response);
        }

        $responseBody = (string) $response->getBody();

        return json_decode($responseBody, true) ?: $responseBody;
    }

    /**
     * Handle the request error.
     *
     * @param  \Psr\Http\Message\ResponseInterface  $response
     * @return void
     *
     * @throws \Exception
     * @throws \Novu\SDK\Exceptions\FailedAction
     * @throws \Novu\SDK\Exceptions\NotFound
     * @throws \Novu\SDK\Exceptions\Validation
     * @throws \Novu\SDK\Exceptions\RateLimitExceeded
     */
    protected function handleRequestError(ResponseInterface $response)
    {
        if ($response->getStatusCode() == 422) {
            throw new ValidationFailed(json_decode((string) $response->getBody(), true));
        }

        if ($response->getStatusCode() == 404) {
            throw new NotFound();
        }

        if ($response->getStatusCode() == 400) {
            throw new FailedAction((string) $response->getBody());
        }

        if ($response->getStatusCode() === 429) {
            throw new RateLimitExceeded(
                $response->hasHeader('x-ratelimit-reset')
                    ? (int) $response->getHeader('x-ratelimit-reset')[0]
                    : null
            );
        }

        throw new Exception((string) $response->getBody());
    }

    /**
     * Retry the callback or fail after x seconds.
     *
     * @param  int  $timeout
     * @param  callable  $callback
     * @param  int  $sleep
     * @return mixed
     *
     * @throws \Novu\SDK\Exceptions\Timeout
     */
    public function retry($timeout, $callback, $sleep = 5)
    {
        $start = time();

        beginning:

        if ($output = $callback()) {
            return $output;
        }

        if (time() - $start < $timeout) {
            sleep($sleep);

            goto beginning;
        }

        if ($output === null || $output === false) {
            $output = [];
        }

        if (! is_array($output)) {
            $output = [$output];
        }

        throw new Timeout($output);
    }
}