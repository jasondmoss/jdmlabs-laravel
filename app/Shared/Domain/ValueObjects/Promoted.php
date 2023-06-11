<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

use Illuminate\Validation\Rules\Enum;

final readonly class Promoted {

    private Enum $promoted;


    /**
     * @param string $promoted
     */
    public function __construct(string $promoted)
    {
        $this->promoted = new Enum(Promoted::class);
    }


    /**
     * @return \Illuminate\Validation\Rules\Enum
     */
    public function value(): Enum
    {
        return $this->promoted;
    }

}
