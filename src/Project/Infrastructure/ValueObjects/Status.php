<?php

declare(strict_types=1);

namespace Aenginus\Project\Infrastructure\ValueObjects;

use Aenginus\Shared\ValueObjects\EnumValueObject;

final class Status extends EnumValueObject
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
