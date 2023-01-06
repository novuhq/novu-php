<?php

namespace Novu\SDK\Resources;

class NotificationGroup extends Resource
{
    /**
     * The internal id Novu generated
     *
     * @var string
     */
    public $id;

    /**
     * The name of the notification group
     *
     * @var string
     */
    public $name;

    /**
     * The parent Id
     *
     * @var string
     */
    public $parentId;

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
     * Return the array form of NotificationGroup object.
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