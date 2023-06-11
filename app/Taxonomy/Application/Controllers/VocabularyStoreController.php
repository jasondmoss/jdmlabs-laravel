<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers;

use App\Shared\Interface\EntryFormRequest;
use App\Taxonomy\Infrastructure\Vocabulary;
use Illuminate\Http\RedirectResponse;

class VocabularyStoreController extends TaxonomyController {

    protected SaveVocabularyUseCase $saveVocabulary;


    public function __construct(SaveVocabularyUseCase $saveVocabulary)
    {
        $this->saveVocabulary = $saveVocabulary;
    }


    public function __invoke(EntryFormRequest $request): RedirectResponse
    {
        $this->authorize('create', Vocabulary::class);

        // Store vocabulary to the database.
        $this->saveVocabulary->__invoke($request);

        return redirect()
            ->route('admin.vocabulary')
            ->with('create', 'The vocabulary has been successfully saved.');
    }

}
