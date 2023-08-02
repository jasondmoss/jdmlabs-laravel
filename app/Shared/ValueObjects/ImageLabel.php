<?php

declare(strict_types=1);

namespace App\Shared\ValueObjects;

use App\Shared\Exceptions\RequiredException;

final readonly class ImageLabel
{

    private string $label;


    /**
     * @param string $label
     */
    public function __construct(string $label)
    {
        if (! $label) {
            throw new RequiredException("The 'label' field is required when uploading an image.");
        }

        $this->label = $label;
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->label;
    }

}
