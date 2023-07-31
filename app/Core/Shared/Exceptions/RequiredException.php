<?php

declare(strict_types=1);

namespace App\Core\Shared\Exceptions;

use DomainException;
use Throwable;

class RequiredException extends DomainException
{

    /**
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(
        string $message = "",
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

}
