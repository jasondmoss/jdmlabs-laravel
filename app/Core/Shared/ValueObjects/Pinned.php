<?php

declare(strict_types=1);

namespace App\Core\Shared\ValueObjects;

use Illuminate\Validation\Rules\Enum;

final readonly class Pinned
{

    private Enum $pinned;


    /**
     * @param string $pinned
     */
    public function __construct(string $pinned)
    {
        $this->pinned = new Enum(Pinned::class);
    }


    /**
     * @return \Illuminate\Validation\Rules\Enum
     */
    public function value(): Enum
    {
        return $this->pinned;
    }

}