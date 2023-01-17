<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Message;

trait ManagesMessages
{

    /**
     * Get Messages [Come back here because of pagination]
     *
     * @return \Novu\SDK\Resources\Message
     */
    public function getMessages()
    {
        $response = $this->get("messages");

        return new Message($response, $this);
    }

    /**
     * Delete Message
     *
     * @param string $messageId
     * @return \Novu\SDK\Resources\Message
     */
    public function deleteMessage($messageId)
    {
        $response = $this->delete("messages/{$messageId}")['data'];

        return new Message($response, $this);
    }

}