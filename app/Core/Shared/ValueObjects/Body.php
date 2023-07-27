<?php

declare(strict_types=1);

namespace App\Core\Shared\ValueObjects;

use App\Core\Shared\Exceptions\RequiredException;

final readonly class Body
{

    private string $body;


    /**
     * @param string $body
     */
    public function __construct(string $body)
    {
        if (! $body) {
            throw new RequiredException('The body field is Required');
        }

        $this->body = $body;
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->body;
    }

}
