<?php

declare(strict_types=1);

namespace App\Providers;

//use App\ArticleEloquentModel\Domain\ArticleEloquentModel;
//use App\ArticleEloquentModel\Domain\ArticlePolicy;
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