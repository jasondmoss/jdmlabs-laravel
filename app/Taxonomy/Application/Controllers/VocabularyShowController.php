<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class VocabularyShowController extends TaxonomyController {

    private GetVocabularyUseCase $getVocabulary;


    public function __construct(GetVocabularyUseCase $getVocabulary)
    {
        $this->getVocabulary = $getVocabulary;
    }


    /**
     * @param string $key
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(string $key): View
    {
        $vocabulary = $this->getVocabulary->__invoke($key);

        return ViewFacade::make('Vocabulary::single', [
            'vocabulary' => $vocabulary
        ]);
    }

}
