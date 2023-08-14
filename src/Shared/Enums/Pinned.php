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
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon pinned"><path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd" /></svg>';
        }

        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon not-pinned"><path fill-rule="evenodd" d="M6.72 5.66l11.62 11.62A8.25 8.25 0 006.72 5.66zm10.56 12.68L5.66 6.72a8.25 8.25 0 0011.62 11.62zM5.105 5.106c3.807-3.808 9.98-3.808 13.788 0 3.808 3.807 3.808 9.98 0 13.788-3.807 3.808-9.98 3.808-13.788 0-3.808-3.807-3.808-9.98 0-13.788z" clip-rule="evenodd" /></svg>';
    }

}
