<?php

namespace Novu\SDK\ValueObjects;

class RetryConfig
{
    /**
     * @var int|null
     */
    public $initialDelay;

    /**
     * @var int|null
     */
    public $retryMax;

    /**
     * @var int|null
     */
    public $waitMax;

    /**
     * @var int|null
     */
    public $waitMin;

    /**
     * @var callable|null
     */
    public $retryCondition;


    /**
     * Specify the retry configuration params.
     *
     * @param int|null $initialDelay
     * @param int|null $waitMin
     * @param int|null $waitMax
     * @param int|null $retryMax
     * @param callable|null $retryCondition
     */
    public function __construct(
        ?int $initialDelay,
        ?int $waitMin,
        ?int $waitMax,
        ?int $retryMax,
        ?callable $retryCondition
    ) {
        $this->initialDelay = $initialDelay ?? $waitMin ?? 1;
        $this->waitMin = $waitMin;
        $this->waitMax = $waitMax;
        $this->retryMax = $retryMax;
        $this->retryCondition = $retryCondition;
    }
}
