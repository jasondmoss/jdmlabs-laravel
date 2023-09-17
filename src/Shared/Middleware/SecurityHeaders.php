<?php

declare(strict_types=1);

namespace Aenginus\Shared\Middleware;

use Closure;

final readonly class SecurityHeaders
{

    /**
     * @param $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next): mixed
    {
        $response = $next($request);

        $response->header('X-XSS-Protection', '1; mode=block');
        $response->header('X-Content-Type-Options', 'nosniff');
        $response->header('X-Frame-Options', 'SAMEORIGIN');
        $response->header('Referrer-Policy', 'same-origin');

        return $response;
    }

}
