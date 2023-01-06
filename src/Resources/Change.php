<?php

namespace Novu\SDK\Resources;

class Change extends Resource
{
    /**
     * The internal id Novu generated.
     *
     * @var string
     */
    public $id;

    /**
     * The creator Id
     *
     * @var string
     */
    public $creatorId;

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
     * The entity Id
     *
     * @var string
     */
    public $entityId;

    /**
     * The parent Id
     *
     * @var string
     */
    public $parentId;

    /**
     * The enabled status
     *
     * @var bool
     */
    public $enabled;

    /**
     * The type
     *
     * @var string
     */
    public $type;

    /**
     * The change
     *
     * @var string
     */
    public $change;

    /**
     * The date/time it was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * Return the array form of Change object.
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