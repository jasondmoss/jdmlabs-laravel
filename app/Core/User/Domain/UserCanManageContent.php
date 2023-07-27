<?php

declare(strict_types=1);

namespace App\Core\User\Domain;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCanManageContent
{

    /**
     * Show 401 error if \Auth::user()->UserCanManageContent() == false
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (! Auth::check()) {
            abort(401, "You are not authorised to manage this site's content: You are not logged in.");
        }

        if (! Auth::user()->canManageContent()) {
            abort(401, "You are not authorised to manage this site's content.");
        }

        return $next($request);
    }

}
