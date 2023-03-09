<?php

namespace Novu\SDK\Resources;

class Environment extends Resource
{

    public function __construct(


        /**
         * The internal id Novu generated.
         *
         * @var string
         */
        private readonly string $id,

        /**
         * The userId.
         *
         * @var string
         */
        private readonly string $userId,

        /**
         * The name of the environment
         *
         * @var string
         */
        private readonly string $name,

        /**
         * The organization id
         *
         * @var string
         */
        private readonly string $organizationId,

        /**
         * The identifier
         *
         * @var string
         */
        private readonly string $identifier,

        /**
         * The api keys of the environment
         *
         * @var array
         */
        private readonly array $apiKeys,

        /**
         * The parent Id
         *
         * @var string
         */
        private readonly string $parentId,

        /**
         * The widget
         *
         * @var object
         */
        private readonly object $widget,

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
     * Gets the user Id
     *
     * @var string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }



    /**
     * Gets the name of the environment.
     *
     * @var string
     */
    public function getName(): string
    {
        return $this->name;
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
     * Gets the identifier
     *
     * @var string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * Gets the api keys of the environment
     *
     * @var array
     */
    public function getApiKeys(): array
    {
        return $this->apiKeys;
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
     * Gets the widget
     *
     * @var object
     */
    public function getWidget(): object
    {
        return $this->widget;
    }


    /**
     * Return the array form of Environment object.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "userId" => $this->userId,
            "name" => $this->name,
            "organizationId" => $this->organizationId,
            "identifier" => $this->identifier,
            "apiKeys" => $this->apiKeys,
            "parentId" => $this->parentId,
            "widget" => $this->widget
        ];
    }
}
