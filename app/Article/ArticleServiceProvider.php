<?php

declare(strict_types=1);

namespace App\Article;

use App\Article\Application\UseCases;
use App\Article\Domain\Contract;
use App\Article\Infrastructure\Repository;
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
            ->needs(Contract\DeleteContract::class)
            ->give(Repository\DeleteRepository::class);

        $this->app->when(UseCases\GetArticleUseCase::class)
            ->needs(Contract\GetContract::class)
            ->give(Repository\GetRepository::class);

        $this->app->when(UseCases\GetPromotedArticlesUseCase::class)
            ->needs(Contract\GetPromotedContract::class)
            ->give(Repository\GetPromotedRepository::class);

        $this->app->when(UseCases\GetPublishedArticlesUseCase::class)
            ->needs(Contract\GetPublishedContract::class)
            ->give(Repository\GetPublishedRepository::class);

        $this->app->when(UseCases\GetRelatedArticlesUseCase::class)
            ->needs(Contract\GetRelatedContract::class)
            ->give(Repository\GetRelatedRepository::class);

        $this->app->when(UseCases\SaveArticleUseCase::class)
            ->needs(Contract\SaveContract::class)
            ->give(Repository\SaveRepository::class);


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
        //
    }

}
