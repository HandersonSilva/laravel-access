<?php

namespace SecurityTools\LaravelAccess\Middleware;

use SecurityTools\LaravelAccess\Services\AccessService;
use Closure;
use Illuminate\Http\Request;

class AccessMiddleware
{
    public function __construct(private readonly AccessService $accessService)
    {
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->accessService->isBlocked($request)) {
            return redirect()->route($this->accessService::DEFAULT_ROUTE_ACCESS);
        }

        return $next($request);
    }
}
