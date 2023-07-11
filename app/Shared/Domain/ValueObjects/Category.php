<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

final readonly class Category
{

    private string $category;


    /**
     * @param string $category
     */
    public function __construct(string $category)
    {
        $this->category = $category;
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->category;
    }

}
