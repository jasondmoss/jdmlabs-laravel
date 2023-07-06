<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

final readonly class Website
{

    private string $website;


    /**
     * @param string $website
     */
    public function __construct(string $website)
    {
        $this->website = $website;
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->website;
    }

}
