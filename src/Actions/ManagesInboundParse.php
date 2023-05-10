<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\InboundParse;

trait ManagesInboundParse
{
   
    /**
     * Validate the MX Record setup for Inbound Parse functionality
     *
     * @return \Novu\SDK\Resources\InboundParse
     */
    public function validateMXRecordForInboundParse()
    {
        $record = $this->get("inbound-parse/mx/status")['data'];

        return new InboundParse($record, $this);
    }
}