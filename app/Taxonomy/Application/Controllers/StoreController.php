<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers;

use App\Shared\Interface\EntryFormRequest;
use App\Taxonomy\Application\UseCases\SaveVocabularyUseCase;
use App\Taxonomy\Infrastructure\Vocabulary;
use Illuminate\Http\RedirectResponse;

class StoreController extends TaxonomyController {

    protected SaveVocabularyUseCase $save;


    public function __construct(SaveVocabularyUseCase $save)
    {
        $this->save = $save;
    }


    public function __invoke(EntryFormRequest $request): RedirectResponse
    {
        $this->authorize('create', Vocabulary::class);

        // Store vocabulary to the database.
        $this->save->__invoke($request);

        return redirect()
            ->route('admin.vocabulary')
            ->with('create', 'The vocabulary has been successfully saved.');
    }

}
