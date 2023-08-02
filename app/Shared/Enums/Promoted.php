<?php

declare(strict_types=1);

namespace App\Shared\Enums;

use App\Shared\Traits\EnumOptions;
use App\Shared\Traits\EnumValues;

enum Promoted: string
{

    use EnumValues, EnumOptions;

    case NO = 'not_promoted';

    case YES = 'promoted';


    /**
     * @param \App\Core\Shared\Enums\Promoted $status
     *
     * @return string
     */
    public static function icon(self $status): string
    {
        if ('promoted' == $status->value) {
            return '<i class="fa-solid fa-award" style="color: #ff5542;"></i>';
        }

        return '<i class="fa-solid fa-not-equal" style="color: #c0bfbc;"></i>';
    }

}
