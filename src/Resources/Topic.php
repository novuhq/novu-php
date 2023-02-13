<?php

namespace Novu\SDK\Resources;

class Topic extends Resource
{
    /**
     * The id of the topic.
     *
     * @var string
     */
    public $id;

    /**
     * The environment id
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
     * The topic key
     *
     * @var string
     */
    public $key;

    /**
     * The topic name
     *
     * @var string
     */
    public $name;

    /**
     * The subscribers attached to this topic
     *
     * @var array
     */
    public $subscribers;

    /**
     * Add Subscribers to this topic
     *
     * @param  array  $data
     * @return array
     */
    public function addSubscribers(array $data)
    {
        return $this->novu->addSubscribersToTopic($this->key, $data);
    }

    /**
     * Remove Subscribers from this topic
     *
     * @param  array  $data
     * @return string
     */
    public function removeSubscribers(array $data)
    {
        return $this->novu->removeSubscribersFromTopic($this->key, $data);
    }

    /**
     * Rename topic
     *
     * @param  array  $data
     * @return array
     */
    public function rename($topicName)
    {
        return $this->novu->renameTopic($this->key, $topicName);
    }


    /**
     * Return the array form of Topic object.
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