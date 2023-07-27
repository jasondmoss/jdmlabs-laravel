<?php

declare(strict_types=1);

namespace App\Core\Shared\ValueObjects;

use App\Core\Shared\Exceptions\RequiredException;

final readonly class Itemprop
{

    private string $itemprop;


    /**
     * @param string $itemprop
     */
    public function __construct(string $itemprop)
    {
        if (! $itemprop) {
            throw new RequiredException(
                'You must provide a valid itemprop value. See https://schema.org/docs/gs.html#microdata_itemprop'
            );
        }

        $this->itemprop = $itemprop;
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->itemprop;
    }

}
