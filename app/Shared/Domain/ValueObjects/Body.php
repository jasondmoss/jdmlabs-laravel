<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

final readonly class Body {

    private Body $body;


    /**
     * @param \App\Shared\Domain\ValueObjects\Body $body
     */
    public function __construct(Body $body)
    {
        $this->body = $body;
    }


    /**
     * @return \App\Shared\Domain\ValueObjects\Body
     */
    public function value(): Body
    {
        return $this->body;
    }

}
