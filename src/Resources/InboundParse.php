<?php

namespace Novu\SDK\Resources;

class InboundParse extends Resource
{
    /**
     * The mxRecordConfigured status.
     *
     * @var bool
     */
    public $mxRecordConfigured;

    /**
     * Return the array form of InboundParse object.
     */
    public function toArray(): array
    {
        return [
            'mxRecordConfigured' => $this->mxRecordConfigured,
        ];
    }
}
