<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Providers;

use App\Core\Laravel\Application\Providers\AuthServiceProvider;
use App\Taxonomy\Domain\Policies\CategoryPolicy;
use App\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;

class CategoryAuthServiceProvider extends AuthServiceProvider
{

    protected $policies = [
        CategoryEloquentModel::class => CategoryPolicy::class
    ];

}
