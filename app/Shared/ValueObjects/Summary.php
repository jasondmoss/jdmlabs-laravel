<?php

declare(strict_types=1);

namespace App\Shared\ValueObjects;

final readonly class Summary
{

    private string $summary;


    /**
     * @param string $summary
     */
    public function __construct(string $summary)
    {
        $this->summary = $summary;
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->summary;
    }

}
