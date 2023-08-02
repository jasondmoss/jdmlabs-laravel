<?php

declare(strict_types=1);

namespace App\Shared\ValueObjects;

use App\Shared\Exceptions\RequiredException;

final readonly class ImageCaption
{

    private string $caption;


    /**
     * @param string $caption
     */
    public function __construct(string $caption)
    {
        if (! $caption) {
            throw new RequiredException("The 'caption' field is required when uploading an image.");
        }

        $this->caption = $caption;
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->caption;
    }

}
