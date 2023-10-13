<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Controllers;

use Aenginus\Article\Domain\Models\ArticleModel;
use Aenginus\Shared\ValueObjects\UlidValueObject;
use Aenginus\Taxonomy\Domain\Models\CategoryModel;
use App\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class EditController extends Controller
{
    protected ArticleModel $article;


    /**
     * @param \Aenginus\Article\Domain\Models\ArticleModel $article
     */
    public function __construct(ArticleModel $article)
    {
        $this->article = $article;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function __invoke(string $id): View
    {
        $article = $this->article->find((new UlidValueObject($id))->value());
        $article->entityDates();
        $article->generatePermalink('article');

        $categories = CategoryModel::where('parent_id', null)->orderBy('name')->get();

        return ViewFacade::make('ArticleAdmin::edit', compact('article', 'categories'));
    }
}
