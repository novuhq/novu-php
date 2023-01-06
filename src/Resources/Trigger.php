<?php

namespace Novu\SDK\Resources;

class Trigger extends Resource
{
    /**
     * The transaction id for trigger.
     *
     * @var string
     */
    public $transactionId;

    /**
     * Return the array form of Trigger object.
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