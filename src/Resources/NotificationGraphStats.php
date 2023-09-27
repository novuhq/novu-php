<?php

namespace Novu\SDK\Resources;

class NotificationGraphStats extends Resource
{
    /**
     * The internal id Novu generated.
     *
     * @var string
     */
    public $id;

    /**
     * The count.
     *
     * @var int
     */
    public $count;

    /**
     * The templates.
     *
     * @var array
     */
    public $templates;

    /**
     * The channels.
     *
     * @var array
     */
    public $channels;

    /**
     * Return the array form of Notification Graph Stats.
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
