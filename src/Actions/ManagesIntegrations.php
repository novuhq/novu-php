<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Integration;

trait ManagesIntegrations
{
   
    /**
     * Get Integrations
     *
     * @return \Novu\SDK\Resources\Integration
     */
    public function getIntegrations()
    {
        $integrations = $this->get("integrations")['data'];

        return new Integration($integrations, $this);
    }

    /**
     * Create integration
     *
     * @return \Novu\SDK\Resources\Integration
     */
    public function createIntegration(array $data)
    {
        $integrations = $this->post("integrations", $data)['data'];

        return new Integration($integrations, $this);
    }

    /**
     * Get Active Integrations
     *
     * @return \Novu\SDK\Resources\Integration
     */
    public function getActiveIntegrations()
    {
        $integrations = $this->get("integrations/active")['data'];

        return new Integration($integrations, $this);
    }

    /**
     * Update Integration
     *
     * @return \Novu\SDK\Resources\Integration
     */
    public function updateIntegration($integrationId, array $data)
    {
        $integrations = $this->put("integrations/{$integrationId}", $data)['data'];

        return new Integration($integrations, $this);
    }

    /**
     * Delete Integration
     *
     * @return \Novu\SDK\Resources\Integration
     */
    public function deleteIntegration($integrationId)
    {
        $integrations = $this->delete("integrations/{$integrationId}")['data'];

        return new Integration($integrations, $this);
    }

    /**
     * Get webhook support status for provider
     * @param string $providerId
     * @return \Novu\SDK\Resources\Integration
     */
    public function getWebhookSupportStatusForProvider($providerId)
    {
        $integrations = $this->get("integrations/webhook/provider/{$providerId}/status")['data'];

        return new Integration($integrations, $this);
    }
}