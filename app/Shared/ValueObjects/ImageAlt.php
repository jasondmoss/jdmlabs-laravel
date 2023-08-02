<?php

declare(strict_types=1);

namespace App\Shared\ValueObjects;

use App\Shared\Exceptions\RequiredException;

final readonly class ImageAlt
{

    private string $alt;


    /**
     * @param string $alt
     */
    public function __construct(string $alt)
    {
        if (! $alt) {
            throw new RequiredException("The 'alt' field is required when uploading an image.");
        }

        $this->alt = $alt;
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->alt;
    }

}
