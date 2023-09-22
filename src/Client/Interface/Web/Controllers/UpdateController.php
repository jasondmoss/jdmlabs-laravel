<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Application\UseCases\UpdateUseCase;
use Aenginus\Client\Domain\Models\ClientModel;
use Aenginus\Client\Infrastructure\Entities\ClientEntity;
use Aenginus\Client\Interface\Web\Requests\UpdateRequest;
use Aenginus\Media\Application\UseCases\SingleImageUseCase;
use App\Controller;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{

    protected ClientModel $client;
    protected UpdateUseCase $bridge;
    protected SingleImageUseCase $logo;


    /**
     * @param \Aenginus\Client\Domain\Models\ClientModel $client
     * @param \Aenginus\Client\Application\UseCases\UpdateUseCase $bridge
     * @param \Aenginus\Media\Application\UseCases\SingleImageUseCase $logo
     */
    public function __construct(
        ClientModel $client,
        UpdateUseCase $bridge,
        SingleImageUseCase $logo
    ) {
        $this->client = $client;
        $this->bridge = $bridge;
        $this->logo = $logo;
    }


    /**
     * @param \Aenginus\Client\Interface\Web\Requests\UpdateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Aenginus\Shared\Exceptions\CouldNotFindModelEntity
     * @throws \ReflectionException
     */
    public function __invoke(UpdateRequest $request): RedirectResponse
    {
        $validated = (object) $request->validated();
        $clientEntity = new ClientEntity($validated);
        $clientInstance = $this->client->find($clientEntity->id);
        $client = $this->bridge->update($clientInstance, $clientEntity);

        // Logo image (single).
        /*if ($request->hasFile('logo_image')) {
            $this->logo->attach(
                $client,
                (object) $request->file('logo_image'),
                'logo'
            );
        }*/

        return redirect()
            ->to($request->listing_page)
            ->with('update', 'Client updated successfully.');
    }

}
