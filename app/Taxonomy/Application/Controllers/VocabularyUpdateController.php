<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers;

use App\Shared\Interface\EntryFormRequest;
use Illuminate\Http\RedirectResponse;

class VocabularyUpdateController extends TaxonomyController {

    protected GetVocabularyUseCase $getVocabulary;

    protected SaveVocabularyUseCase $updateVocabulary;


    public function __construct(
        GetVocabularyUseCase $getVocabulary,
        SaveVocabularyUseCase $updateVocabulary
    )
    {
        $this->getVocabulary = $getVocabulary;
        $this->updateVocabulary = $updateVocabulary;
    }


    /**
     * @param \App\Shared\Interface\EntryFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EntryFormRequest $request): RedirectResponse
    {
        $vocabulary = $this->getVocabulary->__invoke($request->id);
        $this->authorize('owner', $vocabulary);

        // Update vocabulary.
        $this->updateVocabulary->__invoke($request);

        return redirect()
            ->route('admin.vocabulary')
            ->with('update', 'The vocabulary has been updated successfully.');
    }

}
