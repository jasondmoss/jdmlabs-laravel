<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Domain\Models\ClientModel;
use Aenginus\Shared\ValueObjects\UlidValueObject;
use App\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class EditController extends Controller
{
    protected ClientModel $client;


    /**
     * @param \Aenginus\Client\Domain\Models\ClientModel $client
     */
    public function __construct(ClientModel $client)
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
        $client->entityDates();
        $client->generatePermalink();

        return ViewFacade::make('ClientAdmin::edit', compact('client'));
    }
}
