<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Providers;

use App\Laravel\Application\Providers\EventServiceProvider;
use App\Taxonomy\Domain\CategoryObserver;
use App\Taxonomy\Infrastructure\Category;

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
