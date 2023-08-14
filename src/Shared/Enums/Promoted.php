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
            return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon promoted"><path fill-rule="evenodd" d="M14.615 1.595a.75.75 0 01.359.852L12.982 9.75h7.268a.75.75 0 01.548 1.262l-10.5 11.25a.75.75 0 01-1.272-.71l1.992-7.302H3.75a.75.75 0 01-.548-1.262l10.5-11.25a.75.75 0 01.913-.143z" clip-rule="evenodd" /></svg>';
        }

        return '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon not-promoted"><path fill-rule="evenodd" d="M14.615 1.595a.75.75 0 01.359.852L12.982 9.75h7.268a.75.75 0 01.548 1.262l-10.5 11.25a.75.75 0 01-1.272-.71l1.992-7.302H3.75a.75.75 0 01-.548-1.262l10.5-11.25a.75.75 0 01.913-.143z" clip-rule="evenodd" /></svg>';
    }

}
