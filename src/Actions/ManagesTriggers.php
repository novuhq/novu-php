<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Trigger;

trait ManagesTriggers
{
   
    /**
     * Trigger event
     *
     * @param array $data
     * @return \Novu\SDK\Resources\Trigger
     */
    public function triggerEvent(array $data)
    {
        $response = $this->post("events/trigger", $data)['data'];

        return new Trigger($response, $this);
    }

    /**
     * Bulk Trigger event
     *
     * @param array $data
     * @return \Novu\SDK\Resources\Trigger
     */
    public function bulkTriggerEvent(array $data)
    {
        $response = $this->post("events/trigger/bulk", ['events' => $data])['data'];

        return new Trigger($response, $this);
    }

    /**
     * Broadcast event to all
     *
     * @param array $data
     * @return \Novu\SDK\Resources\Trigger
     */
    public function broadcastEvent(array $data)
    {
        $response = $this->post("events/trigger/broadcast", $data)['data'];

        return new Trigger($response, $this);
    }

    /**
     * Cancel triggered event
     *
     * @param string $transactionId
     * @return bool
     */
    public function cancelEvent($transactionId)
    {
        return $this->delete("events/trigger/{$transactionId}")['data'];
    }

}