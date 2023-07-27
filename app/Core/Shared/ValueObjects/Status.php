<?php

declare(strict_types=1);

namespace App\Core\Shared\ValueObjects;

use App\Core\Shared\Exceptions\RequiredException;
use Illuminate\Validation\Rules\Enum;

final readonly class Status
{

    private Enum $status;


    /**
     * @param string $status
     */
    public function __construct(string $status)
    {
        if (! $status) {
            throw new RequiredException('You must declare the status state');
        }

        $this->status = new Enum($status);
    }


    /**
     * @return \Illuminate\Validation\Rules\Enum
     */
    public function value(): Enum
    {
        return $this->status;
    }

}
