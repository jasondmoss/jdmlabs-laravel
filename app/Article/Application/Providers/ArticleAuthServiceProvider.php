<?php

declare(strict_types=1);

namespace App\Article\Application\Providers;

use App\Article\Domain\ArticlePolicy;
use App\Article\Infrastructure\Article;
use App\Laravel\Application\Providers\AuthServiceProvider;

class ArticleAuthServiceProvider extends AuthServiceProvider
{

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Article::class => ArticlePolicy::class
    ];

}
