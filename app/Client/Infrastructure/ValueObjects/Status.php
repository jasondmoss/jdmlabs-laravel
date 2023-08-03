<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\ValueObjects;

use App\Shared\ValueObjects\EnumValueObject;

class Status extends EnumValueObject
{

    /**
     * @param $value
     *
     * @return mixed
     */
    protected function throwExceptionForInvalidValue($value): mixed
    {
        return $value;
    }

}
