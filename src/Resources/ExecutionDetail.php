<?php

namespace Novu\SDK\Resources;

class ExecutionDetail extends Resource
{
     /**
     * The internal id Novu generated.
     *
     * @var string
     */
    public $id;

    /**
     * The job Id
     *
     * @var string
     */
    public $jobId;

    /**
     * The organization id
     *
     * @var string
     */
    public $organizationId;

    /**
     * The environment Id
     *
     * @var string
     */
    public $environmentId;

    /**
     * The notification Id
     *
     * @var string
     */
    public $notificationId;

    /**
     * The notification template Id
     *
     * @var string
     */
    public $notificationTemplateId;

    /**
     * The subscriber Id
     *
     * @var string
     */
    public $subscriberId;

    /**
     * The message Id
     *
     * @var string
     */
    public $messageId;

    /**
     * The provider Id
     *
     * @var string
     */
    public $providerId;

    /**
     * The transaction Id
     *
     * @var string
     */
    public $transactionId;

    /**
     * The channel
     *
     * @var string
     */
    public $channel;

    /**
     * The detail
     *
     * @var string
     */
    public $detail;

    /**
     * The source
     *
     * @var string
     */
    public $source;

    /**
     * The status
     *
     * @var bool
     */
    public $status;

    /**
     * The is test status.
     *
     * @var bool
     */
    public $isTest;

    /**
     * The is retry status
     *
     * @var bool
     */
    public $isRetry;

    /**
     * The date/time it was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * Return the array form of ExecutionDetail object.
     *
     * @return array
     */
    public function toArray(): array
    {
        $publicProperties = get_object_vars($this);

        unset($publicProperties['attributes']);
        unset($publicProperties['novu']);

        return array_filter($publicProperties, function ($value) { 
            return null !== $value;
        });
    }
}