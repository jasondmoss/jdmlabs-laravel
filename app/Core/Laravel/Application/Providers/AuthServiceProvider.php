<?php

declare(strict_types=1);

namespace App\Core\Laravel\Application\Providers;

//use App\Article\Domain\Article;
//use App\Article\Domain\ArticlePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];


    /**
     * Register any authentication/authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }

}