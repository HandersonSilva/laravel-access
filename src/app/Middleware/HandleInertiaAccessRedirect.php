<?php

namespace SecurityTools\LaravelAccess\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;
use SecurityTools\LaravelAccess\Services\AccessService;
use Symfony\Component\HttpFoundation\Response;

class HandleInertiaAccessRedirect
{
    public function __construct(private readonly AccessService $accessService) {}

    /**
     * Ensure Inertia requests trigger a full-page redirect when access is blocked.
     *
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('X-Inertia') && $this->accessService->isBlocked($request)) {
            return Inertia::location(URL::route(AccessService::DEFAULT_ROUTE_ACCESS));
        }

        return $next($request);
    }
}
