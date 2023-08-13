<?php

declare(strict_types=1);

namespace Aenginus\Shared\Enums;

use Aenginus\Shared\Traits\EnumOptions;
use Aenginus\Shared\Traits\EnumValues;

enum Promoted: string
{

    use EnumValues, EnumOptions;

    case NO = 'not_promoted';

    case YES = 'promoted';


    /**
     * @param \Aenginus\Shared\Enums\Promoted $status
     *
     * @return string
     */
    public static function icon(self $status): string
    {
        if ($status->value === 'promoted') {
            return '<i class="fa-solid fa-award h-8 w-8" style="color: #ff5542;"></i>';
        }

        return '<i class="fa-solid fa-not-equal h-8 w-8" style="color: #c0bfbc;"></i>';
    }

}
