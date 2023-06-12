<?php

declare(strict_types=1);

namespace App\Taxonomy\Application\Controllers;

use App\Shared\Domain\ValueObjects\Id;
use App\Taxonomy\Application\UseCases\DeleteVocabularyUseCase;
use App\Taxonomy\Application\UseCases\GetVocabularyUseCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class DestroyController extends TaxonomyController {

    protected DeleteVocabularyUseCase $delete;

    protected GetVocabularyUseCase $get;


    public function __construct(DeleteVocabularyUseCase $delete, GetVocabularyUseCase $get)
    {
        $this->delete = $delete;
        $this->get = $get;
    }


    public function __invoke(string $id): Redirector|RedirectResponse
    {
        $client = $this->get->__invoke((new Id($id))->value());
        $this->authorize('create', $client);

        $this->delete->__invoke($id);

        return redirect()
            ->route('admin.vocabulary')
            ->with('delete', 'The vocabulary has been successfully deleted.');
    }

}
