<?php

declare(strict_types=1);

namespace App\Article;

use App\Article\Domain\ArticlePolicy;
use App\Article\Infrastructure\Article;
use App\Laravel\Application\Providers\AuthServiceProvider;

class ArticleAuthServiceProvider extends AuthServiceProvider
{

    protected $policies = [
        Article::class => ArticlePolicy::class
    ];

}
