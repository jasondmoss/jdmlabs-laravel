<?php

declare(strict_types=1);

namespace App\Core\Shared\ValueObjects;

use App\Core\Shared\Exceptions\RequiredException;

final readonly class Name
{

    private string $name;


    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        if (! $name) {
            throw new RequiredException('The name field is required');
        }

        $this->name = $name;
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->name;
    }

}
