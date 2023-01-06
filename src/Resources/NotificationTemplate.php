<?php

namespace Novu\SDK\Resources;

class NotificationTemplate extends Resource
{
    /**
     * The internal id Novu generated
     *
     * @var string
     */
    public $id;

    /**
     * The name of the template
     *
     * @var string
     */
    public $name;

    /**
     * The description.
     *
     * @var string
     */
    public $description;

    /**
     * The preference settings.
     *
     * @var object
     */
    public $preferenceSettings;

    /**
     * The critical status.
     *
     * @var bool
     */
    public $critical;

    /**
     * The tags.
     *
     * @var array
     */
    public $tags;

    /**
     * The steps.
     *
     * @var array
     */
    public $steps;

    /**
     * The active status.
     *
     * @var bool
     */
    public $active;

    /**
     * The draft status.
     *
     * @var bool
     */
    public $draft;

    /**
     * The deleted status.
     *
     * @var bool
     */
    public $deleted;

    /**
     * The date/time it was deleted.
     *
     * @var string
     */
    public $deletedAt;

    /**
     * The person that deleted it.
     *
     * @var string
     */
    public $deletedBy;

    /**
     * The notification group.
     *
     * @var object
     */
    public $notificationGroup;

    /**
     * The parent Id
     *
     * @var string
     */
    public $parentId;

    /**
     * The notification group Id
     *
     * @var string
     */
    public $notificationGroupId;

    /**
     * The organization id
     *
     * @var string
     */
    public $organizationId;

    /**
     * The creator Id
     *
     * @var string
     */
    public $creatorId;

    /**
     * The environment Id
     *
     * @var string
     */
    public $environmentId;

    /**
     * The triggers
     *
     * @var array
     */
    public $triggers;

    /**
     * Return the array form of NotificationTemplate object.
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