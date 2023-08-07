<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use App\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class PublishedController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $clients = ClientEloquentModel::published()
            ->orderBy('created_at', 'desc')
            ->get()
            ->each(static fn ($client) => $client->generatePermalink());

        return ViewFacade::make('ClientPublic::list', compact('clients'));
    }

}
