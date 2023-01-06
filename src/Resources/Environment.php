<?php

namespace Novu\SDK\Resources;

class Environment extends Resource
{
    /**
     * The internal id Novu generated.
     *
     * @var string
     */
    public $id;

     /**
     * The userId.
     *
     * @var string
     */
    public $userId;

    /**
     * The name of the environment
     *
     * @var string
     */
    public $name;

    /**
     * The organization id
     *
     * @var string
     */
    public $organizationId;

    /**
     * The identifier
     *
     * @var string
     */
    public $identifier;

    /**
     * The api keys of the environment
     *
     * @var array
     */
    public $apiKeys;

    /**
     * The parent Id
     *
     * @var string
     */
    public $parentId;

    /**
     * The widget
     *
     * @var object
     */
    public $widget;

    /**
     * Return the array form of Environment object.
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