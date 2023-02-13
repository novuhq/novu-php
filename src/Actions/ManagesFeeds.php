<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Feed;

trait ManagesFeeds
{

    /**
     * Get Feeds
     *
     * @return \Novu\SDK\Resources\Feed
     */
    public function getFeeds()
    {
        $response = $this->get("feeds")['data'];

        return new Feed($response, $this);
    }

    /**
     * Create Feed
     *
     * @param array $data
     * @return \Novu\SDK\Resources\Feed
     */
    public function createFeed(array $data)
    {
        $response = $this->post("feeds", $data)['data'];

        return new Feed($response, $this);
    }

    /**
     * Delete Feed
     *
     * @param string $feedId
     * @return \Novu\SDK\Resources\Feed
     */
    public function deleteFeed($feedId)
    {
        $response = $this->delete("feeds/{$feedId}")['data'];

        return new Feed($response, $this);
    }

}