<?php

namespace Novu\SDK\Exceptions;

use Exception;

class Timeout extends Exception
{
    /**
     * The output returned from the operation.
     *
     * @var array
     */
    public $output;

    /**
     * Create a new exception instance.
     *
     * @return void
     */
    public function __construct(array $output)
    {
        parent::__construct('Script timed out while waiting for the process to complete.');

        $this->output = $output;
    }

    /**
     * The output returned from the operation.
     *
     * @return array
     */
    public function output()
    {
        return $this->output;
    }
}
