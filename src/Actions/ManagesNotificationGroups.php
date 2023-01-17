<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\NotificationGroup;

trait ManagesNotificationGroups
{
   
    /**
     * Get Notification Groups
     *
     * @return \Novu\SDK\Resources\NotificationGroup
     */
    public function getNotificationGroups()
    {
        $response = $this->get("notification-groups")['data'];

        return new NotificationGroup($response, $this);
    }

    /**
     * Create notification group
     *
     * @return \Novu\SDK\Resources\NotificationGroup
     */
    public function createNotificationGroup(array $data)
    {
        $response = $this->post("notification-groups", $data)['data'];

        return new NotificationGroup($response, $this);
    }

}