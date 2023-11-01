<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Workflow;

trait ManagesWorkflow
{
    /**
     * Get Workflows.
     *
     * @return \Novu\SDK\Resources\Workflow
     */
    public function getWorkflows(int $page = 1, int $limit = 10)
    {
        $response = $this->get('workflows?' . http_build_query(['page' => $page, 'limit' => $limit]))['data'];

        return new Workflow($response, $this);
    }

    /**
     * Create Workflow.
     *
     * @param array $data
     * @return \Novu\SDK\Resources\Workflow
     */
    public function createWorkflow(array $data)
    {
        $response = $this->post('workflows', $data)['data'];

        return new Workflow($response, $this);
    }

    /**
     * Get Workflow.
     *
     * @param string $workflowId
     * @return \Novu\SDK\Resources\Workflow
     */
    public function getWorkflow(string $workflowId)
    {
        $response = $this->get("workflows/{$workflowId}")['data'];

        return new Workflow($response, $this);
    }

    /**
     * Update Workflow.
     *
     * @param string $workflowId
     * @param array $data
     * @return \Novu\SDK\Resources\Workflow
     */
    public function updateWorkflow(string $workflowId, array $data)
    {
        $response = $this->put("workflows/{$workflowId}", $data)['data'];

        return new Workflow($response, $this);
    }

    /**
     * Delete Workflow.
     *
     * @param string $workflowId
     * @return bool
     */
    public function deleteWorkflow(string $workflowId)
    {
        $response = $this->delete("workflows/{$workflowId}")['data'];

        return $response;
    }

    /**
     * Update Workflow Status.
     *
     * @param string $workflowId
     * @param array $data
     * @return \Novu\SDK\Resources\Workflow
     */
    public function updateWorkflowStatus(string $workflowId, array $data)
    {
        $response = $this->put("workflows/{$workflowId}/status", $data)['data'];

        return new Workflow($response, $this);
    }
}
