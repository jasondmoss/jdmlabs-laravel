<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Controllers;

use Aenginus\Article\Domain\Models\ArticleModel;
use App\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class SingleController extends Controller
{
    private ArticleModel $article;


    /**
     * @param \Aenginus\Article\Domain\Models\ArticleModel $article
     */
    public function __construct(ArticleModel $article)
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
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function __invoke(?int $year, ?int $month, ?int $day, string $key): View
    {
        $article = $this->article->find($key);

        $this->authorize('view', $article);

        return ViewFacade::make('ArticlePublic::single', compact('article'));
    }
}
