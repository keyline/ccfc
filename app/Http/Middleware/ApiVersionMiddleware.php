<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiVersionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$versions)
    {

        $requestedVersion = $request->header('X-API-Version');

        if (!in_array($requestedVersion, $versions)) {
            abort(404, 'API version not found.');
        }

        return $next($request);

    }
}
