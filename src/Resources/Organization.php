<?php

namespace Novu\SDK\Resources;

class Organization extends Resource
{
    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $logo;

    /**
     * @var array
     */
    public $branding;

    /**
     * @var array
     */
    public $partnerConfigurations;

    /**
     * @var string
     */
    public $createdAt;


    /**
     * @var string
     */
    public $updatedAt;


    /**
     * @var string
     */
    public $v;


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
