<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Message;

trait ManagesMessages
{

    /**
     * Get Messages
     *
     * @param array $queryParams
     * @return mixed
     */
    public function getMessages(array $queryParams = [])
    {
        $response = $this->get("messages", $queryParams);
        $response['data'] = array_map(function($value){ new Message($value, $this); }, $response['data']);
        return $response;
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