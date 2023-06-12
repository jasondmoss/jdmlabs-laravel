<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers;

use App\Taxonomy\Application\UseCases\GetVocabularyUseCase;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class ShowController extends TaxonomyController {

    private GetVocabularyUseCase $get;


    /**
     * @param \App\Taxonomy\Application\UseCases\GetVocabularyUseCase $get
     */
    public function __construct(GetVocabularyUseCase $get)
    {
        $this->get = $get;
    }


    /**
     * @param string $key
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(string $key): View
    {
        $vocabulary = $this->get->__invoke($key);

        return ViewFacade::make('Vocabulary::single', [
            'vocabulary' => $vocabulary
        ]);
    }

}
