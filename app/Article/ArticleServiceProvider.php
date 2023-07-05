<?php

declare(strict_types=1);

namespace App\Article;

use App\Article\Application\UseCases;
use App\Article\Domain\ArticleRepositoryContract;
use App\Article\Infrastructure\ArticleRepository;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class ArticleServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->when(UseCases\DeleteArticleUseCase::class)
            ->needs(ArticleRepositoryContract::class)
            ->give(ArticleRepository::class);

        $this->app->when(UseCases\GetAllArticlesUseCase::class)
            ->needs(ArticleRepositoryContract::class)
            ->give(ArticleRepository::class);

        $this->app->when(UseCases\GetArticleUseCase::class)
            ->needs(ArticleRepositoryContract::class)
            ->give(ArticleRepository::class);

        $this->app->when(UseCases\GetPromotedArticlesUseCase::class)
            ->needs(ArticleRepositoryContract::class)
            ->give(ArticleRepository::class);

        $this->app->when(UseCases\GetPublishedArticlesUseCase::class)
            ->needs(ArticleRepositoryContract::class)
            ->give(ArticleRepository::class);

        $this->app->when(UseCases\GetRelatedArticlesUseCase::class)
            ->needs(ArticleRepositoryContract::class)
            ->give(ArticleRepository::class);

        $this->app->when(UseCases\SaveArticleUseCase::class)
            ->needs(ArticleRepositoryContract::class)
            ->give(ArticleRepository::class);


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
        // Tell Laravel of our custom HTTP routes path.
//        Route::middleware('web')->group(base_path('routes/article.php'));
    }

}
