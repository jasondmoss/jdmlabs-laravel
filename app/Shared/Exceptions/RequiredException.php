<?php

declare(strict_types=1);

namespace App\Shared\Exceptions;

use DomainException;
use Throwable;

class RequiredException extends DomainException
{

    public function __construct(
        string $message = "",
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

}
