<?php

declare(strict_types=1);

namespace Aenginus\Shared\Providers;

use Aenginus\Article\Domain\Models\ArticleModel;
use Aenginus\Client\Domain\Models\ClientModel;
use Aenginus\Project\Domain\Models\ProjectModel;
use Aenginus\User\Domain\Models\UserModel;
use App\Providers\AuthServiceProvider;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Date;

class SharedServiceProvider extends AuthServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        parent::register();
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();

        Model::preventLazyLoading(! $this->app->isProduction());

        // Configure Laravel to use CarbonImmutable for dates.
        Date::use(CarbonImmutable::class);

        /**
         * Imageable 'types'.
         *
         * @see https://ralphjsmit.com/laravel-fix-no-morph-map-defined
         *
         * // Relation::enforceMorphMap([
         */
        Relation::morphMap([
            'article' => ArticleModel::class,
            'client' => ClientModel::class,
            'project' => ProjectModel::class,
            'projects' => ProjectModel::class,
            'user' => UserModel::class
        ]);
    }
}
