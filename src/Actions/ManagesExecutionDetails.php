<?php

namespace Novu\SDK\Actions;

use Novu\SDK\Resources\ExecutionDetail;

trait ManagesExecutionDetails
{

    /**
     * Get Execution Details
     * 
     * @param $queryParams array
     * @return \Novu\SDK\Resources\ExecutionDetail
     */
    public function getExecutionDetails(array $queryParams = [])
    {

        $uri = 'execution-details';

        if(! empty($queryParams)) {
            $uri .= '?' . http_build_query($queryParams);
        }

        $response = $this->get($uri);

        return new ExecutionDetail($response, $this);
    }

}