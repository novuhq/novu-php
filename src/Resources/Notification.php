<?php

namespace Novu\SDK\Resources;

class Notification extends Resource
{
    /**
     * The internal id Novu generated
     *
     * @var string
     */
    public $id;

    /**
     * The environment Id
     *
     * @var string
     */
    public $environmentId;

    /**
     * The organization id
     *
     * @var string
     */
    public $organizationId;

    /**
     * The transaction id
     *
     * @var string
     */
    public $transactionId;

    /**
     * The createdAt
     *
     * @var string
     */
    public $createdAt;

    /**
     * The channels
     *
     * @var array
     */
    public $channels;

    /**
     * The subscriber
     *
     * @var array
     */
    public $subscriber;

    /**
     * The template
     *
     * @var array
     */
    public $template;

    /**
     * The jobs
     *
     * @var string
     */
    public $jobs;


    /**
     * Return the array form of Notification object.
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