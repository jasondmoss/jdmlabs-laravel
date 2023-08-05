<?php

declare(strict_types=1);

namespace Aenginus\Client\Infrastructure\ValueObjects;

use Aenginus\Shared\ValueObjects\EnumValueObject;

final class Promoted extends EnumValueObject
{

    /**
     * @param $value
     *
     * @return mixed
     */
    public function throwExceptionForInvalidValue($value): mixed
    {
        return $value;
    }

}
