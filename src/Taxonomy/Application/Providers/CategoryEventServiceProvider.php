<?php

declare(strict_types=1);

namespace Aenginus\Taxonomy\Application\Providers;

use Aenginus\Shared\Observers\ModelEntityObserver;
use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use App\Providers\EventServiceProvider;

class CategoryEventServiceProvider extends EventServiceProvider
{
    /**
     * The model observers for your application.
     *
     * @var array
     */
    protected $observers = [
        CategoryModel::class => [ModelEntityObserver::class]
    ];
}
