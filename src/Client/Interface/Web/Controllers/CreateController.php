<?php

declare(strict_types=1);

namespace Aenginus\Client\Interface\Web\Controllers;

use Aenginus\Client\Domain\Models\ClientModel;
use App\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as ViewFacade;

class CreateController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(): View
    {
        $client = new ClientModel();

        return ViewFacade::make('ClientAdmin::create', compact('client'));
    }
}
