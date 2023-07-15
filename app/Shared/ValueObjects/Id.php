<?php

declare(strict_types=1);

namespace App\Shared\ValueObjects;

final readonly class Id
{

    private string $id;


    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->id;
    }

}
