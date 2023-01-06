<?php

namespace Novu\SDK\Resources;

class Feed extends Resource
{
    /**
     * The internal id Novu generated.
     *
     * @var string
     */
    public $id;

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
     * The environment Id
     *
     * @var object
     */
    public $environmentId;

    /**
     * Return the array form of Feed object.
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