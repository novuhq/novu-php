<?php

namespace Novu\SDK\Resources;

class Integration extends Resource
{
    /**
     * The internal id Novu generated for the integration
     *
     * @var string
     */
    public $id;

    /**
     * The channel for the integration
     *
     * @var string
     */
    public $channel;

    /**
     * The id of the organization.
     *
     * @var string
     */
    public $organizationId;

    /**
     * The id of the environment.
     *
     * @var string
     */
    public $environmentId;

    /**
     * The deleted status of the integration.
     *
     * @var bool
     */
    public $deleted;

    /**
     * The active status of the integration.
     *
     * @var bool
     */
    public $active;

    /**
     * The date/time the integration was deleted.
     *
     * @var string
     */
    public $deletedAt;

    /**
     * The person that deleted the integration.
     *
     * @var string
     */
    public $deletedBy;

    /**
     * The credentials.
     *
     * @var string
     */
    public $credentials;

    /**
     * The provider Id
     *
     * @var string
     */
    public $providerId;

    /**
     * Return the array form of Activity object.
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