<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

final readonly class Name
{

    private string $name;


    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->name;
    }

}
