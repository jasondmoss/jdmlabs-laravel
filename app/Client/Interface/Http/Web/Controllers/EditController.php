<?php

declare(strict_types=1);

namespace App\Client\Interface\Http\Web\Controllers;

use App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel;
use App\Core\Laravel\Application\Controller;
use App\Core\Shared\ValueObjects\Id;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class EditController extends Controller
{

    protected ClientEloquentModel $client;


    /**
     * @param \App\Client\Infrastructure\Eloquent\Models\ClientEloquentModel $client
     */
    public function __construct(ClientEloquentModel $client)
    {
        $this->client = $client;
    }


    /**
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View
     * @throws \App\Client\Application\Exceptions\CouldNotFindClient
     */
    public function __invoke(string $id): View
    {
        $client = $this->client->find((new Id($id))->value());

        $logo = $client->getFirstMedia('logos');

        return ViewFacade::make('ClientAdmin::edit', [
            'client' => $client,
            'logo' => $logo
        ]);
    }

}
