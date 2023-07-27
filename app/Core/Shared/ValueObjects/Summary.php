<?php

declare(strict_types=1);

namespace App\Core\Shared\ValueObjects;

use App\Core\Shared\Exceptions\RequiredException;

final readonly class Summary
{

    private string $summary;


    /**
     * @param string $summary
     */
    public function __construct(string $summary)
    {
        if (! $summary) {
            throw new RequiredException('The summary field is required');
        }

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
