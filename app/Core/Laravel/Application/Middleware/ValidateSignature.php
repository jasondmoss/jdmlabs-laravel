<?php

declare(strict_types=1);

namespace App\Core\Laravel\Application\Middleware;

use Illuminate\Routing\Middleware\ValidateSignature as Middleware;

class ValidateSignature extends Middleware
{

    /**
     * The names of the query string parameters that should be ignored.
     *
     * @var array<int, string>
     */
    protected array $except = [
        //        'fbclid',
        //        'utm_campaign',
        //        'utm_content',
        //        'utm_medium',
        //        'utm_source',
        //        'utm_term',
    ];

}