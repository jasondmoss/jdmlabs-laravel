<?php

declare(strict_types=1);

namespace App\Shared\Enums;

use App\Shared\Traits\EnumOptions;
use App\Shared\Traits\EnumValues;

enum Status: string
{

    use EnumValues, EnumOptions;

    case Draft = 'draft';

    case Published = 'published';


    /**
     * @param \App\Core\Shared\Enums\Status $status
     *
     * @return string
     */
    public static function icon(self $status): string
    {
        if ('published' == $status->value) {
            return '<i class="fa-solid fa-eye" style="color: #2ec27e;"></i>';
        }

        return '<i class="fa-solid fa-not-equal" style="color: #c0bfbc;"></i>';
    }

}
