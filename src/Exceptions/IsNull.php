<?php

namespace Novu\SDK\Exceptions;

use Exception;

final class IsNull extends Exception
{
    /** 
     * Create a new Exception instance
     * 
     * @param string $value
     * @return \Novu\SDK\Exceptions\IsNull
     */
    public static function make(string $value)
    {
        return new self("The {$value} is null. Please provide it.");
        
    }
}
