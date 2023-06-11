<?php

declare(strict_types=1);

namespace App\Shared\Domain\Enums;

use App\Shared\Application\Traits\EnumOptions;
use App\Shared\Application\Traits\EnumValues;

enum Status: string {

    use EnumValues, EnumOptions;

    case Draft = 'draft';

    case Published = 'published';


    /**
     * @param \App\Shared\Domain\Enums\Status $status
     *
     * @return string
     */
    public  static function icon(self $status): string
    {
        if ('published' == $status->value) {
            return '<i class="fa-solid fa-eye" style="color: #2ec27e;"></i>';
        }

        return '<i class="fa-solid fa-not-equal" style="color: #c0bfbc;"></i>';
    }

}
