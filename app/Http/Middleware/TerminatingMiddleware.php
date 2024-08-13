<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TerminatingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $time = round(xdebug_time_index() * 1000, 2);
        $response->headers->set('X-Debug-Time', $time);
        $response->headers->set('X-Debug-Memory', round(xdebug_memory_usage() / 1024, 2));
        return $response;
    }

    public function terminate(Request $request, Response $response): void
    {
    }
}
