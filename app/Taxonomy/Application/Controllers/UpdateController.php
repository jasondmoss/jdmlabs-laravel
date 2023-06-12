<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers;

use App\Shared\Interface\EntryFormRequest;
use App\Taxonomy\Application\UseCases\GetVocabularyUseCase;
use App\Taxonomy\Application\UseCases\SaveVocabularyUseCase;
use Illuminate\Http\RedirectResponse;

class UpdateController extends TaxonomyController {

    protected GetVocabularyUseCase $get;

    protected SaveVocabularyUseCase $update;


    public function __construct(GetVocabularyUseCase $get, SaveVocabularyUseCase $update)
    {
        $this->get = $get;
        $this->update = $update;
    }


    /**
     * @param \App\Shared\Interface\EntryFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EntryFormRequest $request): RedirectResponse
    {
        $vocabulary = $this->get->__invoke($request->id);
        $this->authorize('owner', $vocabulary);

        // Update vocabulary.
        $this->update->__invoke($request);

        return redirect()
            ->route('admin.vocabulary')
            ->with('update', 'The vocabulary has been updated successfully.');
    }

}
