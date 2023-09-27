<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Notification;
use Novu\SDK\Resources\NotificationGraphStats;
use Novu\SDK\Resources\NotificationStats;

trait ManagesNotifications
{
    /**
     * Get A Notification.
     *
     * @param string $notificationId
     *
     * @return \Novu\SDK\Resources\Notification
     */
    public function getNotification($notificationId)
    {
        $response = $this->get("notifications/{$notificationId}")['data'];

        return new Notification($response, $this);
    }

    /**
     * Get All Notifications.
     *
     * @return \Novu\SDK\Resources\Notification
     */
    public function getNotifications(array $queryParams = [])
    {
        $uri = 'notifications';

        if (!empty($queryParams)) {
            $uri .= '?' . http_build_query($queryParams);
        }

        $response = $this->get($uri);

        return new Notification($response, $this);
    }

    /**
     * Get Notification Statistics.
     *
     * @return \Novu\SDK\Resources\NotificationStats
     */
    public function getNotificationStats()
    {
        $response = $this->get('notifications/stats')['data'];

        return new NotificationStats($response, $this);
    }

    /**
     * Get Notification Graph Stats.
     *
     * @return \Novu\SDK\Resources\NotificationGraphStats
     */
    public function getNotificationGraphStats(array $queryParams = [])
    {
        $uri = 'notifications/graph/stats';

        if (!empty($queryParams)) {
            $uri .= '?' . http_build_query($queryParams);
        }

        $response = $this->get($uri)['data'];

        return new NotificationGraphStats($response, $this);
    }
}
