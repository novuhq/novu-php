<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Tenant;

trait ManagesTenants
{
    /**
     * Create a new tenant.
     *
     * @param  array $data
     * @return \Novu\SDK\Resources\Tenant
     */
    public function createTenant(array $data)
    {
        $tenant = $this->post('tenants', $data)['data'];

        return new Tenant($tenant, $this);
    }

    /**
     * Update a given tenant.
     *
     * @param string $tenantId
     *
     * @return \Novu\SDK\Resources\Tenant
     */
    public function updateTenant($tenantId, array $data)
    {
        $tenant = $this->patch("tenants/{$tenantId}", $data)['data'];

        return new Tenant($tenant, $this);
    }

    /**
     * Delete the given tenant.
     *
     * @param string $tenantId
     *
     * @return \Novu\SDK\Resources\Tenant
     */
    public function deleteTenant($tenantId)
    {
        $response = $this->delete("tenants/{$tenantId}")['data'];

        return new Tenant($response, $this);
    }

    /**
     * Fetch list of tenant.
     *
     * @return \Novu\SDK\Resources\Tenant
     */
    public function getTenantList(array $queryParams = [])
    {
        $uri = 'tenants';

        if (!empty($queryParams)) {
            $uri .= '?' . http_build_query($queryParams);
        }

        $tenants = $this->get($uri);

        return new Tenant($tenants, $this);
    }

    /**
     * Fetch one tenant.
     *
     * @param string $tenantId
     *
     * @return \Novu\SDK\Resources\Tenant
     */
    public function getTenant($tenantId)
    {
        $tenant = $this->get("tenant/{$tenantId}")['data'];

        return new Tenant($tenant, $this);
    }
}
