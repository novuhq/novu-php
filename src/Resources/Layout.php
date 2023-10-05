<?php

namespace Novu\SDK\Resources;

class Layout extends Resource
{
    /**
     * The internal id Novu generated
     *
     * @var string
     */
    public $id;

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
     * The parent Id
     *
     * @var string
     */
    public $parentId;

    /**
     * The channel of the layout
     *
     * @var string - Available options: in_app, email, sms, chat, push 
     */
    public $channel;

    /**
     * The content.
     *
     * @var string
     */
    public $content;

    /**
     * The content type.
     *
     * @var object
     */
    public $contentType;

    /**
     * The date/time it was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The description.
     *
     * @var string
     */
    public $description;

    /**
     * The identifier
     *
     * @var string
     */
    public $identifier;

    /**
     * The default status.
     *
     * @var bool
     */
    public $isDefault;

    /**
     * The delete status.
     *
     * @var bool
     */
    public $isDeleted;

    /**
     * The name of the layout
     *
     * @var string
     */
    public $name;

    /**
     * The date/time it was updated.
     *
     * @var string
     */
    public $updatedAt;

    /**
     * The variables.
     *
     * @var array
     */
    public $variables;

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