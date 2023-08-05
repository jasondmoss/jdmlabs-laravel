<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Application\Providers;

use Aenginus\Taxonomy\Domain\Policies\CategoryPolicy;
use Aenginus\Taxonomy\Infrastructure\Eloquent\Models\CategoryEloquentModel;
use App\Providers\AuthServiceProvider;

class CategoryAuthServiceProvider extends AuthServiceProvider
{

    protected $policies = [
        CategoryEloquentModel::class => CategoryPolicy::class
    ];

}
