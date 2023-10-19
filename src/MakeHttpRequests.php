<?php

namespace Novu\SDK;

use Closure;
use Exception;
use Novu\SDK\Exceptions\FailedAction;
use Novu\SDK\Exceptions\NotFound;
use Novu\SDK\Exceptions\RateLimitExceeded;
use Novu\SDK\Exceptions\ValidationFailed;
use Psr\Http\Message\ResponseInterface;

trait MakeHttpRequests
{
    /**
     * Make a GET request to Novu servers and return the response.
     *
     * @param  string  $uri
     * @param  array  $query
     * @return mixed
     */
    public function get($uri, array $query = [])
    {
        return $this->request('GET', $uri, [], $query);
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
     * @param  array  $query
     * @return mixed
     */
    protected function request($verb, $uri, array $payload = [], array $query = [])
    {
        if (isset($payload['json'])) {
            $payload = ['json' => $payload['json']];
        } else {
            $payload = empty($payload) ? [] : ['form_params' => $payload];
        }

        if (! empty($query)) {
            $payload = array_merge($payload, ['query' => $query]);
        }

        $shouldRetry = null;

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
     * @throws \Novu\SDK\Exceptions\ValidationFailed
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
     * Retry an operation a given number of times.
     *
     * @param  int|array  $times
     * @param  callable  $callback
     * @param  int|\Closure  $sleepMilliseconds
     * @param  callable|null  $when
     * @return mixed
     *
     * @throws \Exception
     */
    public function retry($times, callable $callback, $sleepMilliseconds = 0, $when = null)
    {
        $attempts = 0;

        $backoff = [];

        if (is_array($times)) {
            $backoff = $times;

            $times = count($times) + 1;
        }

        beginning:
        $attempts++;
        $times--;

        try {
            return $callback($attempts);
        } catch (Exception $e) {
            if ($times < 1 || ($when && ! $when($e))) {
                throw $e;
            }

            $sleepMilliseconds = $backoff[$attempts - 1] ?? $sleepMilliseconds;

            if ($sleepMilliseconds) {
                usleep($this->value($sleepMilliseconds, $attempts, $e) * 1000);
            }

            goto beginning;
        }
    }

    /**
     * Return the default value of the given value.
     *
     * @param  mixed  $value
     * @param  mixed  ...$args
     * @return mixed
     */
    private function value($value, ...$args)
    {
        return $value instanceof Closure ? $value(...$args) : $value;
    }
}
