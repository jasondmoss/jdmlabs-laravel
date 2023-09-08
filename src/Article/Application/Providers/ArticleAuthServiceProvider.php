<?php

declare(strict_types=1);

namespace Aenginus\Article\Application\Providers;

use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use Aenginus\Shared\Policies\ModelEntityPolicy;
use App\Providers\AuthServiceProvider;

class ArticleAuthServiceProvider extends AuthServiceProvider
{

    /**
     * The model to policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        ArticleEloquentModel::class => ModelEntityPolicy::class
    ];

}
