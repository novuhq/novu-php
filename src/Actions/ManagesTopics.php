<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Topic;

trait ManagesTopics
{
    /**
     * Create a new topic.
     *
     * @param  array $data
     * @return \Novu\SDK\Resources\Topic
     */
    public function createTopic(array $data)
    {
        $topic = $this->post("topics", $data)['data'];

        return new Topic($topic, $this);
    }

    /**
     * Fetch one topic
     *
     * @param  string $topicId
     * @return \Novu\SDK\Resources\Topic
     */
    public function getTopics()
    {
        return $this->get("topics")['data'];
    }

    /**
     * Add Subscribers to Topic
     *
     * @param  string $topicKey
     * @param  array  $data
     * @return void
     */
    public function addSubscribersToTopic($topicKey, array $data)
    {
        return $this->post("topics/{$topicKey}/subscribers", ['subscribers' => $data])['data'];
    }

    /**
     * Remove Subscribers from this Topic
     *
     * @param  string $topicKey
     * @param  array  $data
     * @return void
     */
    public function removeSubscribersFromTopic($topicKey, array $data)
    {
        return $this->post("topics/{$topicKey}/subscribers/removal", ['subscribers' => $data]);
    }

    /**
     * Get Topic
     *
     * @param  string $topicKey
     * @return \Novu\SDK\Resources\Topic
     */
    public function topic($topicKey)
    {
        $topic = $this->get("topics/{$topicKey}")['data'];

        return new Topic($topic, $this);
    }

    /**
     * Rename Topic
     *
     * @param  string $topicKey
     * @param  string $topicName 
     * @return array
     */
    public function renameTopic($topicKey, $topicName)
    {
        return $this->patch("topics/{$topicKey}", ['name' => $topicName])['data'];
    }
}