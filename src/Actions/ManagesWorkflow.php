<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\Workflow;

trait ManagesWorkflow
{
    public function getWorkflows(int $page = 1, int $limit = 10)
    {

        $response =   $this->get('workflows'. '?' . http_build_query(['page' => $page, 'limit' => $limit]))['data'];
        return new Workflow($response, $this);
    }

    public function createWorkflow(array $data)
    {
        $response =   $this->post('workflows', $data)['data'];
        return new Workflow($response, $this);

    }

    public function getWorkflow(string $workflowId)
    {
        $response =   $this->get("workflows/{$workflowId}")['data'];
        return new Workflow($response, $this);
    }

    public function updateWorkflow(string $workflowId, array $data)
    {
        $response =   $this->put("workflows/{$workflowId}", $data)['data'];
        return new Workflow($response, $this);
    }

    /**
     * @param string $workflowId
     * @return boolean
     */
    public function deleteWorkflow(string $workflowId)
    {
        $response =   $this->delete("workflows/{$workflowId}")['data'];
        return $response;
    }

    public function updateWorkflowStatus(string $workflowId, array $data)
    {
        $response =   $this->put("workflows/{$workflowId}/status", $data)['data'];
        return new Workflow($response, $this);
    }
}
