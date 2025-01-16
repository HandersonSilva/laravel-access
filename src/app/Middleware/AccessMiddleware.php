<?php

namespace SecurityTools\LaravelAccess\Middleware;

use SecurityTools\LaravelAccess\Services\AccessService;
use Closure;
use Illuminate\Http\Request;

class AccessMiddleware
{
    const DEFAULT_ROUTE_PREFIX = '/access';

    public function __construct(private readonly AccessService $accessService)
    {
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $isBlocked = $this->accessService->isBlocked($request);
        $prefix = $this->accessService->getPrefix($request);

        if (self::DEFAULT_ROUTE_PREFIX === $prefix && !$isBlocked) {
            $this->accessService->logout(null);
        }

        if ($isBlocked) {
            return redirect()->route('access.index');
        }

        return $next($request);
    }
}
