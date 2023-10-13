<?php

declare(strict_types=1);

namespace Aenginus\Shared\Traits;

trait EnumValues
{
    /**
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
