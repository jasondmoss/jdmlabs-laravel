<?php

declare(strict_types=1);

namespace App\Core\Shared\ValueObjects;

use App\Core\Shared\Exceptions\RequiredException;

final readonly class Id
{

    private string $id;


    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        if (! $id) {
            throw new RequiredException('A valid Ulid string is Required');
        }

        $this->id = $id;
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->id;
    }

}
