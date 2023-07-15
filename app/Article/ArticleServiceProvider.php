<?php

declare(strict_types=1);

namespace App\Article;

use App\Article\Application\UseCases;
use App\Article\Domain\Contracts;
use App\Article\Infrastructure\Repositories;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class ArticleServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->when(UseCases\DeleteArticleUseCase::class)
            ->needs(Contracts\DeleteContract::class)
            ->give(Repositories\DeleteRepository::class);

//        $this->app->when(UseCases\GetArticleUseCase::class)
//            ->needs(Contracts\GetContract::class)
//            ->give(Repositories\GetRepository::class);

        $this->app->when(UseCases\GetPromotedArticlesUseCase::class)
            ->needs(Contracts\GetPromotedContract::class)
            ->give(Repositories\GetPromotedRepository::class);

        $this->app->when(UseCases\GetPublishedArticlesUseCase::class)
            ->needs(Contracts\GetPublishedContract::class)
            ->give(Repositories\GetPublishedRepository::class);

        $this->app->when(UseCases\GetRelatedArticlesUseCase::class)
            ->needs(Contracts\GetRelatedContract::class)
            ->give(Repositories\GetRelatedRepository::class);

        $this->app->when(UseCases\StoreArticleUseCase::class)
            ->needs(Contracts\StoreContract::class)
            ->give(Repositories\StoreRepository::class);


        // Tell Laravel of our custom templates path.
        View::addNamespace('ArticleAdmin', resource_path('views/ae/article'));
        View::addNamespace('ArticlePublic', resource_path('views/public/article'));
    }


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        Date::use(CarbonImmutable::class);
    }

}
