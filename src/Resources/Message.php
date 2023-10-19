<?php

namespace Novu\SDK\Resources;

class Message extends Resource
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
     * The environment Id
     *
     * @var string
     */
    public $environmentId;

    /**
     * The channel of the meesage
     *
     * @var string - Available options: in_app, email, sms, chat, push, digest, trigger, delay 
     */
    public $channel;

    /**
     * The transaction Id
     *
     * @var string
     */
    public $transactionId;

    /**
     * The date/time it was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The jobs property
     * It contains the details of the job
     *
     * @var object
     */
    public $jobs;

    /**
     * The subscriber attached to the message.
     *
     * @var object
     */
    public $subscriber;

    /**
     * The template of the message.
     *
     * @var object
     */
    public $template;

    /**
     * Return the array form of Message object.
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