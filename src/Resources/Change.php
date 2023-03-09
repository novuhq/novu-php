<?php

namespace Novu\SDK\Resources;

class Change extends Resource
{

    public function __construct(

        /**
         * The internal id Novu generated.
         *
         * @var string
         */
        private readonly string $id,

        /**
         * The creator Id
         *
         * @var string
         */
        private readonly string $creatorId,

        /**
         * The organization id
         *
         * @var string
         */
        private readonly string $organizationId,

        /**
         * The environment Id
         *
         * @var string
         */
        private readonly string $environmentId,

        /**
         * The entity Id
         *
         * @var string
         */
        private readonly string $entityId,

        /**
         * The parent Id
         *
         * @var string
         */
        private readonly string $parentId,

        /**
         * The enabled status
         *
         * @var bool
         */
        private readonly bool $enabled,

        /**
         * The type
         *
         * @var string
         */
        private readonly string $type,

        /**
         * The change
         *
         * @var string
         */
        private readonly string $change,

        /**
         * The date/time it was created.
         *
         * @var string
         */
        private readonly string $createdAt
    ) {
    }



    /**
     * Gets the internal id Novu generated.
     *
     * @var string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Gets the creator Id
     *
     * @var string
     */
    public function getCreatorId(): string
    {
        return $this->creatorId;
    }


    /**
     * Gets the organization Id
     *
     * @var string
     */
    public function getOrganizationId(): string
    {
        return $this->organizationId;
    }

    /**
     * Gets the environment Id
     *
     * @var string
     */
    public function getEnvironmentId(): string
    {
        return $this->environmentId;
    }

    /**
     * Gets the entity Id
     *
     * @var string
     */
    public function getEntityId(): string
    {
        return $this->entityId;
    }

    /**
     * Gets the parent Id
     *
     * @var string
     */
    public function getParentId(): string
    {
        return $this->parentId;
    }

    /**
     * Gets the enabled status
     *
     * @var bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }


    /**
     * Gets the type
     *
     * @var string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Gets the change
     *
     * @var string
     */
    public function getChange(): string
    {
        return $this->change;
    }

    /**
     * Gets the date/time it was created.
     *
     * @var string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }



    /**
     * Return the array form of Change object.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "creatorId" => $this->creatorId,
            "organizationId" => $this->organizationId,
            "environmentId" => $this->environmentId,
            "entityId" => $this->entityId,
            "parentId" => $this->parentId,
            "enabled" => $this->enabled,
            "type" => $this->type,
            "change" => $this->change,
            "createdAt" => $this->createdAt
        ];
    }
}
