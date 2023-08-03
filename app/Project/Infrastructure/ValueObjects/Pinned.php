<?php

declare(strict_types=1);

namespace App\Project\Infrastructure\ValueObjects;

use App\Shared\ValueObjects\EnumValueObject;

class Pinned extends EnumValueObject
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

