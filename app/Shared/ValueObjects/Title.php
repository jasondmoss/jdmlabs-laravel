<?php

declare(strict_types=1);

namespace App\Shared\ValueObjects;

use App\Shared\Exceptions\RequiredException;

final readonly class Title
{

    private string $title;


    /**
     * @param string $title
     */
    public function __construct(string $title)
    {
        if (! $title) {
            throw new RequiredException('The title field is Required');
        }

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
