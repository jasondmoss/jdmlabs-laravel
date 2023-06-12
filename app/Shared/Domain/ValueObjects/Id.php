<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

final readonly class Id {

    private int|string $id;


    /**
     * @param int|string $id
     */
    public function __construct(int|string $id)
    {
        $this->id = $id;
    }


    /**
     * @return int|string
     */
    public function value(): int|string
    {
        return $this->id;
    }

}
