<?php

namespace Novu\SDK\Resources;

class Subscriber extends Resource
{
    /**
     * The internal id Novu generated for the subscriber.
     *
     * @var string
     */
    public $id;

    /**
     * The id of the subscriber. The same id of the user in your systems.
     *
     * @var string
     */
    public $subscriberId;

    /**
     * The first name of the subscriber
     *
     * @var string
     */
    public $firstName;

    /**
     * The last name of the subscriber
     *
     * @var string
     */
    public $lastName;

    /**
     * The email of the subscriber.
     *
     * @var string
     */
    public $email;

    /**
     * The phone No of the subscriber.
     *
     * @var string
     */
    public $phone;

    /**
     * The avatar of the subscriber.
     *
     * @var string
     */
    public $avatar;

    /**
     * The channels settings for the subscriber
     *
     * @var array
     */
    public $channels;

    /**
     * The id of the organization.
     *
     * @var string
     */
    public $organizationId;

    /**
     * The id of the environment.
     *
     * @var string
     */
    public $environmentId;

    /**
     * The deleted status of the subscriber.
     *
     * @var bool
     */
    public $deleted;

    /**
     * The date/time the subscriber was created.
     *
     * @var string
     */
    public $createdAt;

    /**
     * The date/time the subscriber was updated.
     *
     * @var string
     */
    public $updatedAt;

    public function delete()
    {
        $this->novu->deleteSubscriber($this->subscriberId);
    }

    /**
     * Return the array form of Subscriber object & strip out all null fields.
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