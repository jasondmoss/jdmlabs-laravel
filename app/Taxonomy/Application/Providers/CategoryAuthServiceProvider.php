<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Providers;

use App\Laravel\Application\Providers\AuthServiceProvider;
use App\Taxonomy\Domain\CategoryPolicy;
use App\Taxonomy\Infrastructure\Category;

class CategoryAuthServiceProvider extends AuthServiceProvider
{

    protected $policies = [
        Category::class => CategoryPolicy::class
    ];

}
