<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class VocabularyEditController extends TaxonomyController {

    protected GetVocabularyUseCase $getVocabulary;


    public function __construct(GetVocabularyUseCase $getVocabulary)
    {
        $this->getVocabulary = $getVocabulary;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(string $id): View
    {
        $vocabulary = $this->getVocabulary->__invoke($id);

        $this->authorize('owner', $vocabulary);

        return ViewFacade::make('Vocabulary::edit', [
            'vocabulary' => $vocabulary
        ]);
    }

}
