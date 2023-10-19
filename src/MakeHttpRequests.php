<?php

namespace Novu\SDK;

use Closure;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
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

    protected function populateRequestPayload(array $payload = [], array $query = [])
    {
        if (isset($payload['json'])) {
            $payload = ['json' => $payload['json']];
        } else {
            $payload = empty($payload) ? [] : ['form_params' => $payload];
        }

        if (! empty($query)) {
            $payload = array_merge($payload, ['query' => $query]);
        }

        return $payload;
    }

    /**
     * Make request to Novu servers and return the response.
     *
     * @param string $method
     * @param string $uri
     * @param array $payload
     * @param array $query
     * @return mixed
     * @throws GuzzleException|Exception
     */
    protected function request($method, $uri, array $payload = [], array $query = [])
    {
        $payload = $this->populateRequestPayload($payload, $query);

        $shouldRetry = null;

        return $this->retry($this->retryConfig->retryMax ?? 1, function ($attempt) use ($method, $uri, $payload, &$shouldRetry) {
            $response = $this->buildClient()->request($method, $uri, $payload);

            $statusCode = $response->getStatusCode();

            $isSucessful = $statusCode >= 200 && $statusCode < 300;

            if (! $isSucessful) {
                $e = $this->handleRequestError($response);

                try {
                    $shouldRetry = is_callable($this->retryConfig->retryCondition)
                        ? call_user_func($this->retryConfig->retryCondition, $e)
                        : $this->getDefaultRetryCondition($e);
                } catch (Exception $exception) {
                    $shouldRetry = false;

                    throw $exception;
                }

                if ((! empty ($retries = $this->retryConfig->retryMax) && $attempt < $retries) && $shouldRetry) {
                    throw $e;
                }

                throw $e;
            }

            $responseBody = (string) $response->getBody();

            return json_decode($responseBody, true) ?: $responseBody;

        }, $this->determineBackoff(), function ($exception) use (&$shouldRetry) {
            $result = $shouldRetry ??
                (is_callable($this->retryConfig->retryCondition)
                    ? call_user_func($this->retryConfig->retryCondition, $exception)
                    : $this->getDefaultRetryCondition($exception));

            $shouldRetry = null;

            return $result;
        });
    }

    /**
     * Calculate the time delay for the next request.
     *
     * @return \Closure
     */
    protected function determineBackoff()
    {
        $minDelay = $this->retryConfig->waitMin ?? 1;
        $maxDelay = $this->retryConfig->waitMax ?? 30;
        $initialDelay = $this->retryConfig->initialDelay ?? $minDelay;

        return function ($attempt) use ($minDelay, $maxDelay, $initialDelay) {
            if ($attempt === 1) {
                return $initialDelay;
            }

            $delay = $attempt * $minDelay;
            if ($delay > $maxDelay) {
                return $maxDelay;
            }

            return $delay;
        };
    }

    /**
     * Get default retry condition callback
     *
     * @param Exception $exception
     * @return bool
     */
    protected function getDefaultRetryCondition($exception)
    {
        if ($exception->getCode() >= 500 && $exception->getCode() <= 599) {
            return true;
        }

        if (in_array($exception->getCode(), [408, 429, 422])) {
            return true;
        }

        return false;
    }

    /**
     * Handle the request error.
     *
     * @param  \Psr\Http\Message\ResponseInterface  $response
     * @return mixed
     */
    protected function handleRequestError(ResponseInterface $response)
    {
        if ($response->getStatusCode() == 422) {
            return new ValidationFailed(json_decode((string) $response->getBody(), true));
        }

        if ($response->getStatusCode() == 404) {
            return new NotFound();
        }

        if ($response->getStatusCode() == 400) {
            return new FailedAction((string) $response->getBody());
        }

        if ($response->getStatusCode() === 429) {
            return new RateLimitExceeded(
                $response->hasHeader('x-ratelimit-reset')
                    ? (int) $response->getHeader('x-ratelimit-reset')[0]
                    : null
            );
        }

        return new Exception((string) $response->getBody());
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
