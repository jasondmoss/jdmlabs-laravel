<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

final readonly class Itemprop
{

    private string $itemprop;


    /**
     * @param string $itemprop
     */
    public function __construct(string $itemprop)
    {
        $this->itemprop = $itemprop;
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->itemprop;
    }

}
