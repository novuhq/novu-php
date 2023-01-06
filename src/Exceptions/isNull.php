<?php

declare(strict_types=1);

namespace Novu\SDK\Exceptions;

use Exception;

final class IsNull extends Exception
{
    /** 
     *  Create a new Exception instance
     *  @var string
     */
    public static function make(string $value)
    {
        return new self("The `{$value}` can not be null. Please provide it.");
    }
}