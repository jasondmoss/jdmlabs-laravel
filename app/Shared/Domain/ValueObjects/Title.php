<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

readonly final class Title {

    private string $title;


    /**
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->title;
    }

}
