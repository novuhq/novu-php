<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Environment;

trait ManagesEnvironments
{
   
    /**
     * Get current environment
     *
     * @return \Nova\SDK\Resources\Environment
     */
    public function getCurrentEnvironment()
    {
        $response = $this->get("environments/me")['data'];

        return new Environment($response, $this);
    }

    /**
     * Get All environments
     *
     * @return \Nova\SDK\Resources\Environment
     */
    public function getEnvironments()
    {
        $response = $this->get("environments")['data'];

        return new Environment($response, $this);
    }

    /**
     * Get API keys
     *
     * @return \Nova\SDK\Resources\Environment
     */
    public function getEnvironmentsAPIKeys()
    {
        $response = $this->get("environments/api-keys")['data'];

        return new Environment($response, $this);
    }

     /**
     * Regenerate API keys
     *
     * @param array $data
     * @return \Nova\SDK\Resources\Environment
     */
    public function regenerateEnvironmentsAPIKeys(array $data = [])
    {
        $response = $this->post("environments/api-keys/regenerate", $data)['data'];

        return new Environment($response, $this);
    }

    /**
     * Create environment
     *
     * @param array $data
     * @return \Nova\SDK\Resources\Environment
     */
    public function createEnvironment(array $data)
    {
        $response = $this->post("environments", $data)['data'];

        return new Environment($response, $this);
    }

    /**
     * Update environment by id
     *
     * @param string $environmentId
     * @return \Nova\SDK\Resources\Environment
     */
    public function updateEnvironment($environmentId, array $data)
    {
        $response = $this->post("environments/{$environmentId}", $data)['data'];

        return new Environment($response, $this);
    }

    /**
     * Update widget settings
     *
     * @param array  $data
     * @return \Nova\SDK\Resources\Environment
     */
    public function updateWidgetSettings(array $data)
    {
        $response = $this->put("environments/widget/settings", $data)['data'];

        return new Environment($response, $this);
    }

}