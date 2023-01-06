<?php

declare(strict_types=1);

namespace Novu\Exceptions;

use Exception;

final class IsNull extends Exception
{
    public static function make(string $value)
    {
        return new self("The `{$value}` can not be null. Please provide it.");
    }
}