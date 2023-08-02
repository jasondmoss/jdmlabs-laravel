<?php

declare(strict_types=1);

namespace App\Article\Interface\Web\Controllers;

use App\Article\Infrastructure\Eloquent\Models\ArticleEloquentModel;
use App\Core\Laravel\Application\Controller;
use Carbon\Carbon;
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
            ->get();

        /**
         * Generate a 'permalink' for each article, using the published_at
         * date (Y/m/d).
         */
        $articles->each(function ($article, $key) {
            $date = Carbon::parse($article->published_at)->format('Y/m/d');

            $article->permalink = url("/article/$date/$article->slug");
        });

        return ViewFacade::make('ArticlePublic::list', [
            'articles' => $articles
        ]);
    }

}
