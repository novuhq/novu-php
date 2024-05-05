<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Organization;
use Novu\SDK\Resources\Topic;
use Novu\SDK\Resources\Workflow;

trait ManagesOrganizations
{
    /**
     * Get Organizations.
     *
     * @return \Novu\SDK\Resources\Organization
     */
    public function getOrganizationsList()
    {
        $response = $this->get('organizations')['data'];

        return new Organization($response, $this);
    }

    /**
     * Create a new topic.
     *
     * @param  array $data
     * @return \Novu\SDK\Resources\Organization
     */
    public function createOrganization(array $data)
    {
        $topic = $this->post("organizations", $data)['data'];

        return new Topic($topic, $this);
    }
}
