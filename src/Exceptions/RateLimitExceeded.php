<?php

namespace Novu\SDK\Exceptions;

use Exception;

final class RateLimitExceeded extends Exception
{
    /**
     * The timestamp that the rate limit will be reset.
     *
     * @var int|null
     */
    public $rateLimitResetsAt;

    /**
     * Create a new exception instance.
     *
     * @param  int|null  $rateLimitReset
     * @return void
     */
    public function __construct($rateLimitReset)
    {
        parent::__construct('Too Many Requests.');

        $this->rateLimitResetsAt = $rateLimitReset;
    }
}