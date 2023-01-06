<?php

namespace Novu\SDK\Resources;

class Activity extends Resource
{
    /**
     * The internal id Novu generated for the activity graph stats.
     *
     * @var string
     */
    public $id;

    /**
     * The number of stats
     *
     * @var int
     */
    public $count;

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