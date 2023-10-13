<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Domain\Models\ClientModel;
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
        $clients = ClientModel::published()->orderBy('created_at', 'desc')->with('projects')->get()->each(
                static function ($client) {
                    $client->entityDates();
                    $client->generatePermalink('client');
                }
            );

        return ViewFacade::make('ClientPublic::list', compact('clients'));
    }

}
