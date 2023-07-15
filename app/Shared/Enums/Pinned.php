<?php

declare(strict_types=1);

namespace App\Shared\Enums;

use App\Shared\Traits\EnumOptions;
use App\Shared\Traits\EnumValues;

enum Pinned: string
{

    use EnumValues, EnumOptions;

    case NotPinned = 'not_pinned';

    case IsPinned = 'pinned';


    /**
     * @param \App\Shared\Enums\Pinned $status
     *
     * @return string
     */
    public static function icon(self $status): string
    {
        if ('pinned' == $status->value) {
            return '<i class="fa-solid fa-thumbtack"></i>';
        }

        return '<i class="fa-solid fa-not-equal" style="color: #c0bfbc;"></i>';
    }

}
