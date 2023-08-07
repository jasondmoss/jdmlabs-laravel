<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use Aenginus\Client\Infrastructure\ValueObjects\Id;
use App\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class EditController extends Controller
{

    protected ClientEloquentModel $client;


    /**
     * @param \Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel $client
     */
    public function __construct(ClientEloquentModel $client)
    {
        $this->client = $client;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \Aenginus\Client\Application\Exceptions\CouldNotFindClient
     */
    public function __invoke(string $id): View
    {
        $client = $this->client->find((new Id($id))->value());

        $client->generatePermalink();

        $logo = $client->getFirstMedia('logos');

        return ViewFacade::make('ClientAdmin::edit', compact('client', 'logo'));
    }

}
