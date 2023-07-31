<?php

declare(strict_types=1);

namespace App\Core\Auth\Interface\Http\Controllers;

use App\Core\Laravel\Application\Controller;
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
        /** @noinspection PhpUndefinedFieldInspection */
        $confirmed = $request->user()->confirmTwoFactorAuth($request->code);

        if (! $confirmed) {
            return back()->withErrors('Invalid Two Factor Authentication code');
        }

        return back();
    }

}
