<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Controllers;

use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use App\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class SingleController extends Controller
{

    private ArticleEloquentModel $article;


    /**
     * @param \Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel $article
     */
    public function __construct(ArticleEloquentModel $article)
    {
        $this->article = $article;
    }


    /**
     * @param ?int $year
     * @param ?int $month
     * @param ?int $day
     * @param string $key
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \Aenginus\Article\Application\Exceptions\CouldNotFindArticle
     */
    public function __invoke(
        int|null $year,
        int|null $month,
        int|null $day,
        string $key
    ): View
    {
        $article = $this->article->find($key);

        $signature = $article->getFirstMedia('signature');

        return ViewFacade::make('ArticlePublic::single', compact('article', 'signature'));
    }

}
