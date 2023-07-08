<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

use Illuminate\Validation\Rules\Enum;

final readonly class Status
{

    private Enum $status;


    /**
     * @param string $status
     */
    public function __construct(string $status)
    {
        /*$this->status = new Enum(Status::class);*/
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
