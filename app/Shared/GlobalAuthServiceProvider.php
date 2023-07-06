<?php

declare(strict_types=1);

namespace App\Shared;

use App\Laravel\Application\Providers\AuthServiceProvider;
use App\Shared\Domain\GlobalUserPolicy;
use Illuminate\Database\Eloquent\Model;

class GlobalAuthServiceProvider extends AuthServiceProvider
{

    protected $policies = [
        Model::class => GlobalUserPolicy::class
    ];

}
