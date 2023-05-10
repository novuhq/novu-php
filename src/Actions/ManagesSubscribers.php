<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Subscriber;

trait ManagesSubscribers
{
    /**
     * Create a new subscriber.
     *
     * @param  array $data
     * @param  bool  $wait
     * @return \Novu\SDK\Resources\Subscriber
     */
    public function createSubscriber(array $data, $wait = true)
    {
        $subscriber = $this->post("subscribers", $data)['data'];

        return new Subscriber($subscriber, $this);
    }

    /**
     * Update a given subscriber
     *
     * @param  string $subscriberId
     * @param  array  $data
     * @return \Novu\SDK\Resources\Subscriber
     */
    public function updateSubscriber($subscriberId, array $data)
    {
        $subscriber = $this->put("subscribers/{$subscriberId}", $data)['data'];

        return new Subscriber($subscriber, $this);
    }

    /**
     * Delete the given subscriber.
     *
     * @param  string  $subscriberId
     * @return \Novu\SDK\Resources\Subscriber
     */
    public function deleteSubscriber($subscriberId)
    {
        $response = $this->delete("subscribers/{$subscriberId}")['data'];

        return new Subscriber($response, $this);
    }

    /**
     * Update a given subscriber credentials [ Come back to this---->]
     *
     * @param  string $subscriberId
     * @param  array  $data
     * @return \Novu\SDK\Resources\Subscriber
     */
    public function updateSubscriberCredentials($subscriberId, array $data)
    {
        $subscriber = $this->put("subscribers/{$subscriberId}/credentials", $data)['data'];

        return new Subscriber($subscriber, $this);
    }

    /**
     * Fetch list of subscribers [ Come back to this for pagination---->]
     *
     * @return \Novu\SDK\Resources\Subscriber
     */
    public function getSubscriberList()
    {
        $subscribers = $this->get("subscribers");

        return new Subscriber($subscribers, $this);
    }

    /**
     * Fetch one subscriber
     *
     * @param  string $subscriberId
     * @return \Novu\SDK\Resources\Subscriber
     */
    public function getSubscriber($subscriberId)
    {
        $subscriber = $this->get("subscribers/{$subscriberId}")['data'];

        return new Subscriber($subscriber, $this);
    }

    /**
     * Fetch a subscriber preferences
     *
     * @param  string  $subscriberId
     * @return \Novu\SDK\Resources\Subscriber
     */
    public function getSubscriberPreferences($subscriberId)
    {
        $preferences = $this->get("subscribers/{$subscriberId}/preferences")['data'];

        return new Subscriber($preferences, $this);
    }

    /**
     * Update a given subscriber preferences [ Come back to this---->]
     *
     * @param  string $subscriberId
     * @param  string $templateId
     * @param  array  $data
     * @return \Novu\SDK\Resources\Subscriber
     */
    public function updateSubscriberPreference($subscriberId, $templateId, array $data)
    {
        $subscriber = $this->patch("subscribers/{$subscriberId}/preferences/{$templateId}", $data)['data'];

        return new Subscriber($subscriber, $this);
    }

    /**
     * Update subscriber online status
     *
     * @param  string $subscriberId
     * @param  bool $isOnlineStatus
     * @return \Novu\SDK\Resources\Subscriber
     */
    public function updateSubscriberOnlineStatus($subscriberId, $isOnlineStatus)
    {
        $subscriber = $this->patch("subscribers/{$subscriberId}/online-status", 
            [
                'json' => [
                    'isOnline' => $isOnlineStatus
                ]
            ]
        )['data'];

        return new Subscriber($subscriber, $this);
    }

    /**
     * Get a notification feed for a particular subscriber [Come back to this for pagination]
     *
     * @param  string  $subscriberId
     * @return \Novu\SDK\Resources\Subscriber
     */
    public function getNotificationFeedForSubscriber($subscriberId)
    {
        $feed = $this->get("subscribers/{$subscriberId}/notifications/feed");

        return new Subscriber($feed, $this);
    }

    /**
     * Get the unseen notification count for subscribers feed
     *
     * @param  string  $subscriberId
     * @return \Novu\SDK\Resources\Subscriber
     */
    public function getUnseenNotificationCountForSubscriber($subscriberId)
    {
        $feed = $this->get("subscribers/{$subscriberId}/notifications/unseen")['data'];

        return new Subscriber($feed, $this);
    }

    /**
     * Mark a subscriber feed message as seen - [Deprecated]
     *
     * @param  string  $subscriberId
     * @param  string  $messageId
     * @param  array $data
     * @param  bool  $wait
     * @return \Novu\SDK\Resources\Subscriber
     */
    public function markSubscriberFeedMessageAsSeen($subscriberId, $messageId, array $data, $wait = true)
    {
        $subscriber = $this->post("subscribers/{$subscriberId}/messages/{$messageId}/seen", $data)['data'];

        return new Subscriber($subscriber, $this);
    }

    /**
     * Mark message action as seen - [Deprecated]
     *
     * @param  string  $subscriberId
     * @param  string  $messageId
     * @param  string  $type
     * @param  array   $data
     * @param  bool    $wait
     * @return \Novu\SDK\Resources\Subscriber
     */
    public function markSubscriberMessageActionAsSeen($subscriberId, $messageId, $type, array $data, $wait = true)
    {
        $subscriber = $this->post("subscribers/{$subscriberId}/messages/{$messageId}/actions/{$type}", $data)['data'];

        return new Subscriber($subscriber, $this);
    }
}