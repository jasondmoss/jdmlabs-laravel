<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Application\Providers;

use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use Aenginus\Taxonomy\Domain\Policies\CategoryPolicy;
use App\Providers\AuthServiceProvider;

class CategoryAuthServiceProvider extends AuthServiceProvider
{
    protected $policies = [
        CategoryModel::class => CategoryPolicy::class
    ];
}
