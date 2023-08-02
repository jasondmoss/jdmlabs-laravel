<?php

declare(strict_types=1);

namespace App\Shared\ValueObjects;

use App\Shared\Exceptions\RequiredException;

final readonly class Website
{

    private string $website;


    /**
     * @param string $website
     */
    public function __construct(string $website)
    {
        if (! $website || ! filter_var($website, FILTER_VALIDATE_URL)) {
            throw new RequiredException('You must provide a valid website URL');
        }

        $this->website = $website;
    }


    /**
     * @return string
     */
    public function value(): string
    {
        return $this->website;
    }

}
