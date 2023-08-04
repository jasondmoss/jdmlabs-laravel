<?php

declare(strict_types=1);

namespace App\Client\Interface\Web\Controllers;

use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use App\Core\Laravel\Application\Controller;
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
            ->each(fn ($client) => $client->generatePermalink());

        return ViewFacade::make('ClientPublic::list', [
            'clients' => $clients
        ]);
    }

}
