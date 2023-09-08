<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Infrastructure\EloquentModels\ClientEloquentModel;
use Aenginus\Shared\ValueObjects\UlidValueObject;
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
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     */
    public function __invoke(string $id): View
    {
        $client = $this->client->find((new UlidValueObject($id))->value());

        $client->generatePermalink();

        $logo = $client->getFirstMedia('logo');

        return ViewFacade::make(
            'ClientAdmin::edit',
            compact('client', 'logo')
        );
    }

}
