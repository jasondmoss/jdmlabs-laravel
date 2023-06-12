<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers;

use App\Taxonomy\Application\UseCases\GetVocabularyUseCase;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class EditController extends TaxonomyController {

    protected GetVocabularyUseCase $get;


    public function __construct(GetVocabularyUseCase $get)
    {
        $this->get = $get;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(string $id): View
    {
        $vocabulary = $this->get->__invoke($id);

        $this->authorize('owner', $vocabulary);

        return ViewFacade::make('Vocabulary::edit', [
            'vocabulary' => $vocabulary
        ]);
    }

}
