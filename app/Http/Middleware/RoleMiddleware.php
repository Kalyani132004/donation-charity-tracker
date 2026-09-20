<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Allow the request through only if the logged-in user's role
     * matches one of the roles passed to the middleware.
     *
     * Usage in routes: ->middleware('role:admin')
     *                  ->middleware('role:admin,staff')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user() || ! in_array($request->user()->role, $roles)) {
            abort(403, 'You are not authorized to access this page.');
        }

        return $next($request);
    }
}
