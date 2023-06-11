<?php

declare(strict_types=1);

namespace App\Shared\Domain\Enums;

use App\Shared\Application\Traits\EnumOptions;
use App\Shared\Application\Traits\EnumValues;

enum Pinned: string {

    use EnumValues, EnumOptions;

    case NotPinned = 'not_pinned';

    case IsPinned = 'pinned';


    /**
     * @param \App\Shared\Domain\Enums\Pinned $status
     *
     * @return string
     */
    public  static function icon(self $status): string
    {
        if ('pinned' == $status->value) {
            return '<i class="fa-solid fa-thumbtack"></i>';
        }

        return '<i class="fa-solid fa-not-equal" style="color: #c0bfbc;"></i>';
    }

}
