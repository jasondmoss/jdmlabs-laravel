<?php

declare(strict_types=1);

namespace Aenginus\Article\Application\Providers;

use Aenginus\Article\Domain\Models\ArticleModel;
use Aenginus\Article\Domain\Policies\ArticlePolicy;
use App\Providers\AuthServiceProvider;

class ArticleAuthServiceProvider extends AuthServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        ArticleModel::class => ArticlePolicy::class
    ];
}
