<?php

declare(strict_types=1);

namespace App\Shared\ValueObjects;

final readonly class Slug
{

    private string $slug;


    /**
     * @param string $slug
     */
    public function __construct(string $slug)
    {
        $this->slug = $slug;
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->slug;
    }

}
