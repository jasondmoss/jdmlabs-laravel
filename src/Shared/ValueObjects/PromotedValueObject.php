<?php

declare(strict_types=1);

namespace Aenginus\Shared\ValueObjects;

final class PromotedValueObject extends EnumValueObject
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
