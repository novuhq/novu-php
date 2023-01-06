<?php

namespace Novu\SDK\Exceptions;

use Exception;

final class IsEmpty extends Exception
{
    /** 
     * Create a new Exception instance
     * 
     * @param string $value
     * @return \Novu\SDK\Exceptions\IsEmpty
     */
    public static function make(string $value)
    {
        return new self("The `{$value}` is empty. Please provide it.");
    }
}