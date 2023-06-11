<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers;

use Illuminate\Support\Facades\View as ViewFacade;
use Illuminate\View\View;

class VocabularyListController extends TaxonomyController {

    /**
     * @return \Illuminate\View\View
     */
    public function __invoke(): View
    {
        return ViewFacade::make('Vocabulary::show');
    }

}
