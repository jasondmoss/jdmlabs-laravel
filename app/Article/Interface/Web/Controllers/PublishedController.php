<?php

declare(strict_types=1);

namespace App\Article\Interface\Web\Controllers;

use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use App\Core\Laravel\Application\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class PublishedController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $articles = ArticleEloquentModel::published()
            ->orderBy('created_at', 'desc')
            ->get()
            ->each(function ($article) {
                $article->generateDates();
                $article->generatePermalink();
            });

        return ViewFacade::make('ArticlePublic::list', [
            'articles' => $articles
        ]);
    }

}
