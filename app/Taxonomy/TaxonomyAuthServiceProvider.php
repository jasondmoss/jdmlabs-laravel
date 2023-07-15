<?php

declare(strict_types=1);

namespace App\Taxonomy;

use App\Laravel\Application\Providers\AuthServiceProvider;
use App\Taxonomy\Category\Domain\CategoryPolicy;
use App\Taxonomy\Category\Infrastructure\Category;

class TaxonomyAuthServiceProvider extends AuthServiceProvider
{

    protected $policies = [
        Category::class => CategoryPolicy::class
    ];

}
