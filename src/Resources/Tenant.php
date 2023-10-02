<?php

namespace Novu\SDK\Resources;

class Tenant extends Resource
{
    /**
     * The internal id Novu generated.
     *
     * @var string
     */
    public $id;

    /**
     * The creation date.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The tenant data.
     *
     * @var object
     */
    public $data;

    /**
     * The identifier.
     *
     * @var string
     */
    public $identifier;

    /**
     * The tenant name.
     *
     * @var string
     */
    public $name;

    /**
     * The update date.
     *
     * @var string
     */
    public $updatedAt;

    /**
     * The environment Id.
     *
     * @var string
     */
    public $environmentId;

    /**
     * Return the array form of Tenant object.
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
