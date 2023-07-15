<?php

declare(strict_types=1);

namespace App\Shared\ValueObjects;

final readonly class Body
{

    private string $body;


    /**
     * @param string $body
     */
    public function __construct(string $body)
    {
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
