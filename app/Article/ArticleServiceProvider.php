<?php

declare(strict_types=1);

namespace App\Article;

use App\Article\Application\UseCases;
use App\Article\Domain\Contract\DeleteContract;
use App\Article\Domain\Contract\GetAllContract;
use App\Article\Domain\Contract\GetContract;
use App\Article\Domain\Contract\GetPromotedContract;
use App\Article\Domain\Contract\GetPublishedContract;
use App\Article\Domain\Contract\GetRelatedContract;
use App\Article\Domain\Contract\SaveContract;
use App\Article\Infrastructure\Repository\DeleteRepository;
use App\Article\Infrastructure\Repository\GetAllRepository;
use App\Article\Infrastructure\Repository\GetPromotedRepository;
use App\Article\Infrastructure\Repository\GetPublishedRepository;
use App\Article\Infrastructure\Repository\GetRelatedRepository;
use App\Article\Infrastructure\Repository\GetRepository;
use App\Article\Infrastructure\Repository\SaveRepository;
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
            ->needs(DeleteContract::class)
            ->give(DeleteRepository::class);

        $this->app->when(UseCases\GetAllArticlesUseCase::class)
            ->needs(GetAllContract::class)
            ->give(GetAllRepository::class);

        $this->app->when(UseCases\GetArticleUseCase::class)
            ->needs(GetContract::class)
            ->give(GetRepository::class);

        $this->app->when(UseCases\GetPromotedArticlesUseCase::class)
            ->needs(GetPromotedContract::class)
            ->give(GetPromotedRepository::class);

        $this->app->when(UseCases\GetPublishedArticlesUseCase::class)
            ->needs(GetPublishedContract::class)
            ->give(GetPublishedRepository::class);

        $this->app->when(UseCases\GetRelatedArticlesUseCase::class)
            ->needs(GetRelatedContract::class)
            ->give(GetRelatedRepository::class);

        $this->app->when(UseCases\SaveArticleUseCase::class)
            ->needs(SaveContract::class)
            ->give(SaveRepository::class);


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
