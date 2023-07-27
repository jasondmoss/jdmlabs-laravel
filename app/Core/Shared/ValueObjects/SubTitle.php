<?php

declare(strict_types=1);

namespace App\Core\Shared\ValueObjects;

use App\Core\Shared\Exceptions\RequiredException;

final readonly class SubTitle
{

    private string $subtitle;


    /**
     * @param string $subtitle
     */
    public function __construct(string $subtitle)
    {
        if (! $subtitle) {
            throw new RequiredException('The sub-title must be a string');
        }

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
