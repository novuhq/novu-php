<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Activity;

trait ManagesActivity
{
   
    /**
     * Get Activity Feed [ Come back to this for pagination and query parameters---->]
     *
     * @return \Novu\SDK\Resources\Activity
     */
    public function getActivityFeed()
    {
        $activities = $this->get("activity");

        return new Activity($activities, $this);
    }

    /**
     * Get Activity Statistics
     *
     * @return \Novu\SDK\Resources\Activity
     */
    public function getActivityStatistics()
    {
        $activities = $this->get("activity/stats")['data'];

        return new Activity($activities, $this);
    }

    /**
     * Get activity graph statistics
     *
     * @return \Novu\SDK\Resources\Activity
     */
    public function getActivityGraphStatistics()
    {
        $activities = $this->get("activity/graph/stats")['data'];

        return new Activity($activities, $this);
    }
}