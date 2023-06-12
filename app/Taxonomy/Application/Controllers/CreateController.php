<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers;

use App\Taxonomy\Infrastructure\Vocabulary;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class CreateController extends TaxonomyController {

    public function __construct() {}


    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $this->authorize('create', Vocabulary::class);

        return ViewFacade::make('Vocabulary::create', [
            'vocabulary' => (new Vocabulary())
        ]);
    }

}
