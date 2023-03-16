<?php

namespace Novu\SDK\Resources;

use Novu\SDK\Novu;

class ExecutionDetail extends Resource
{
    public function __construct(
        /**
         * The internal id Novu generated.
         *
         * @var string
         */
        private readonly string $id,

        /**
         * The job Id.
         *
         * @var string
         */
        private readonly string $jobId,

        /**
         * The organization id.
         *
         * @var string
         */
        private readonly string $organizationId,

        /**
         * The environment Id.
         *
         * @var string
         */
        private readonly string $environmentId,

        /**
         * The notification Id.
         *
         * @var string
         */
        private readonly string $notificationId,

        /**
         * The notification template Id.
         *
         * @var string
         */
        private readonly string $notificationTemplateId,

        /**
         * The subscriber Id.
         *
         * @var string
         */
        private readonly string $subscriberId,

        /**
         * The message Id.
         *
         * @var string
         */
        private readonly string $messageId,

        /**
         * The provider Id.
         *
         * @var string
         */
        private readonly string $providerId,

        /**
         * The transaction Id.
         *
         * @var string
         */
        private readonly string $transactionId,

        /**
         * The channel.
         *
         * @var string
         */
        private readonly string $channel,

        /**
         * The detail.
         *
         * @var string
         */
        private readonly string $detail,

        /**
         * The source.
         *
         * @var string
         */
        private readonly string $source,

        /**
         * The status.
         *
         * @var bool
         */
        private readonly bool $status,

        /**
         * The is test status.
         *
         * @var bool
         */
        private readonly bool $isTest,

        /**
         * The is retry status.
         *
         * @var bool
         */
        private readonly bool $isRetry,

        /**
         * The date/time it was created.
         *
         * @var string
         */
        private readonly string $createdAt,
    ) {
    }

    /**
     * Return the array form of ExecutionDetail object.
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'                     => $this->id,
            'jobId'                  => $this->jobId,
            'organizationId'         => $this->organizationId,
            'environmentId'          => $this->environmentId,
            'notificationId'         => $this->notificationId,
            'notificationTemplateId' => $this->notificationTemplateId,
            'subscriberId'           => $this->subscriberId,
            'messageId'              => $this->messageId,
            'providerId'             => $this->providerId,
            'transactionId'          => $this->transactionId,
            'channel'                => $this->channel,
            'detail'                 => $this->detail,
            'source'                 => $this->source,
            'status'                 => $this->status,
            'isTest'                 => $this->isTest,
            'isRetry'                => $this->isRetry,
            'createdAt'              => $this->createdAt,
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getJobId(): string
    {
        return $this->jobId;
    }

    public function getOrganizationId(): string
    {
        return $this->organizationId;
    }

    public function getEnvironmentId(): string
    {
        return $this->environmentId;
    }

    public function getNotificationId(): string
    {
        return $this->notificationId;
    }

    public function getNotificationTemplateId(): string
    {
        return $this->notificationTemplateId;
    }

    public function getSubscriberId(): string
    {
        return $this->subscriberId;
    }

    public function getMessageId(): string
    {
        return $this->messageId;
    }

    public function getProviderId(): string
    {
        return $this->providerId;
    }

    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function getDetail(): string
    {
        return $this->detail;
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function isStatus(): bool
    {
        return $this->status;
    }

    public function isTest(): bool
    {
        return $this->isTest;
    }

    public function isRetry(): bool
    {
        return $this->isRetry;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
