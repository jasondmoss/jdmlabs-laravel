<?php

declare(strict_types=1);

namespace Aenginus\Shared\Enums;

use Aenginus\Shared\Traits\EnumOptions;
use Aenginus\Shared\Traits\EnumValues;

enum Pinned: string
{

    use EnumValues, EnumOptions;

    case NotPinned = 'not_pinned';

    case IsPinned = 'pinned';


    /**
     * @param \Aenginus\Shared\Enums\Pinned $status
     *
     * @return string
     */
    public static function icon(self $status): string
    {
        if ($status->value === 'pinned') {
            return '<i class="fa-solid fa-thumbtack"></i>';
        }

        return '<i class="fa-solid fa-not-equal" style="color: #c0bfbc;"></i>';
    }

}
