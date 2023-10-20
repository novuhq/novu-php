<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Activity;

trait ManagesActivity
{
    /**
     * Get Activity Feed
     *
     * @return Activity[]
     */
    public function getActivityFeed(): array
    {
        return $this->getActivity("activity");
    }

    /**
     * Get Activity Statistics
     *
     * @return Activity[]
     */
    public function getActivityStatistics(): array
    {
        return $this->getActivity("activity/stats");
    }

    /**
     * Get Activity Graph Statistics
     *
     * @return Activity[]
     */
    public function getActivityGraphStatistics(): array
    {
        return $this->getActivity("activity/graph/stats");
    }

    /**
     * Common method for fetching activity data
     *
     * @param string $endpoint
     * @return Activity[]
     */
    private function getActivity(string $endpoint): array
    {
        $activities = $this->get($endpoint)['data'];

        return array_map(function ($activity) {
            return new Activity($activity, $this);
        }, $activities);
    }
}
