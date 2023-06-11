<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

final readonly class SubTitle {

    private string $subtitle;


    /**
     * @param string $subtitle
     */
    public function __construct(string $subtitle)
    {
        $this->subtitle = $subtitle;
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->subtitle;
    }

}
