<?php

declare(strict_types=1);

namespace Aenginus\Shared\Enums;

use Aenginus\Shared\Traits\EnumOptions;
use Aenginus\Shared\Traits\EnumValues;

enum Status: string
{

    use EnumValues, EnumOptions;

    case Draft = 'draft';

    case Published = 'published';


    /**
     * @param \Aenginus\Shared\Enums\Status $status
     *
     * @return string
     */
    public static function icon(self $status): string
    {
        if ($status->value === 'published') {
            return '<i class="fa-solid fa-eye h-8 w-8" style="color: #2ec27e;"></i>';
        }

        return '<i class="fa-solid fa-not-equal h-8 w-8" style="color: #c0bfbc;"></i>';
    }

}
