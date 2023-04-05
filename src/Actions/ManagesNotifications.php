<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Notification;
use Novu\SDK\Resources\NotificationStats;
use Novu\SDK\Resources\NotificationGraphStats;

trait ManagesNotifications
{
   
    /**
     * Get A Notification
     *
     * @param  string $notificationId
     * @return \Novu\SDK\Resources\Notification
     */
    public function getNotification($notificationId)
    {
        $response = $this->get("notifications/{$notificationId}");

        return new Notification($response, $this);
    }

     /**
     * Get All Notifications
     *
     * @return \Novu\SDK\Resources\Notification
     */
    public function getNotifications()
    {
        $response = $this->get("notifications")['data'];

        return new Notification($response, $this);
    }

     /**
     * Get Notification Statistics 
     *
     * @return \Novu\SDK\Resources\NotificationStats
     */
    public function getNotificationStats()
    {
        $response = $this->get("notifications/stats")['data'];

        return new NotificationStats($response, $this);
    }

    /**
     * Get Notification Graph Stats
     *
     * @return \Novu\SDK\Resources\NotificationGraphStats
     */
    public function getNotificationGraphStats()
    {
        $response = $this->get("notifications/graph/stats")['data'];

        return new NotificationGraphStats($response, $this);
    }

}