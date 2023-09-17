<?php

declare(strict_types=1);

namespace Aenginus\Article\Interface\Web\Controllers;

use Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel;
use Aenginus\Shared\ValueObjects\UlidValueObject;
use Aenginus\Taxonomy\Infrastructure\EloquentModels\CategoryEloquentModel;
use App\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class EditController extends Controller
{

    protected ArticleEloquentModel $article;


    /**
     * @param \Aenginus\Article\Infrastructure\EloquentModels\ArticleEloquentModel $article
     */
    public function __construct(ArticleEloquentModel $article)
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

        $signature = $article->getFirstMedia('signature');

        $categories = CategoryEloquentModel::get()->pluck('name', 'id');

        return ViewFacade::make(
            'ArticleAdmin::edit',
            compact('article', 'categories', 'signature')
        );
    }

}
