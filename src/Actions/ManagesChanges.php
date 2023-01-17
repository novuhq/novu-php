<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Change;

trait ManagesChanges
{
   
    /**
     * Get Changes
     *
     * @return \Novu\SDK\Resources\Change
     */
    public function getChanges()
    {
        $response = $this->get("changes");

        return new Change($response, $this);
    }

    /**
     * Get Changes Count
     *
     * @return \Novu\SDK\Resources\Change
     */
    public function getChangesCount()
    {
        $response = $this->get("changes/count")['data'];

        return new Change($response, $this);
    }

    /**
     * Apply Bulk Changes
     *
     * @return \Novu\SDK\Resources\Change
     */
    public function applyBulkChanges(array $data)
    {
        $response = $this->post("changes/bulk/apply", $data)['data'];

        return new Change($response, $this);
    }

    /**
     * Apply Change
     *
     * @param string $changeId
     * @return \Novu\SDK\Resources\Change
     */
    public function applyChange($changeId, array $data)
    {
        $response = $this->post("changes/{$changeId}/apply", $data)['data'];

        return new Change($response, $this);
    }

}