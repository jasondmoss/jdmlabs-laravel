<?php

declare(strict_types=1);

namespace Aenginus\User\Interface\Web\Controllers;

use App\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TwoFactorAuthController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $confirmed = $request->user()->confirmTwoFactorAuth($request->code);

        if (! $confirmed) {
            return back()->withErrors('Invalid Two Factor Authentication code');
        }

        return back();
    }
}
