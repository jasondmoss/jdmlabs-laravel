<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\Providers;

use App\Laravel\Application\Providers\AuthServiceProvider;
use App\Taxonomy\Category\Domain\CategoryPolicy;
use App\Taxonomy\Category\Infrastructure\Category;

class CategoryAuthServiceProvider extends AuthServiceProvider
{

    protected $policies = [
        Category::class => CategoryPolicy::class
    ];

}
