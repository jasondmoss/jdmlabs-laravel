<?php

declare(strict_types=1);

namespace App\Taxonomy\Category\Application\Providers;

use App\Laravel\Application\Providers\EventServiceProvider;
use App\Taxonomy\Category\Domain\CategoryObserver;
use App\Taxonomy\Category\Infrastructure\Category;

class CategoryEventServiceProvider extends EventServiceProvider
{

    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        Category::class => [ CategoryObserver::class ]
    ];

}
