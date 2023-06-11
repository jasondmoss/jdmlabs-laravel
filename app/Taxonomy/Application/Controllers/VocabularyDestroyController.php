<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers;

use App\Shared\Domain\ValueObjects\Id;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class VocabularyDestroyController extends TaxonomyController {

    protected DeleteVocabularyUseCase $deleteVocabulary;

    protected GetVocabularyUseCase $getVocabulary;


    public function __construct(
        DeleteVocabularyUseCase $deleteVocabulary,
        GetVocabularyUseCase $getVocabulary
    )
    {
        $this->deleteVocabulary = $deleteVocabulary;
        $this->getVocabulary = $getVocabulary;
    }


    public function __invoke(string $id): Redirector|RedirectResponse
    {
        $client = $this->getVocabulary->__invoke((new Id($id))->value());
        $this->authorize('create', $client);

        $this->deleteVocabulary->__invoke($id);

        return redirect()
            ->route('admin.vocabulary')
            ->with('delete', 'The vocabulary has been successfully deleted.');
    }

}
