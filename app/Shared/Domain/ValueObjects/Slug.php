<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

readonly final class Slug {

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
