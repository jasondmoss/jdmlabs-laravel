<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Controllers;

use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use App\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class PublishedController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $articles = ArticleEloquentModel::select([
                'id', 'title', 'slug', 'promoted'
            ])
            ->published()
            ->orderBy('created_at', 'desc')
            ->get()
            ->each(static fn ($article) => $article->entityDates())
            ->each(static fn ($article) => $article->generatePermalink('article'));

        return ViewFacade::make('ArticlePublic::list', [
            'articles' => $articles
        ]);
    }

}
