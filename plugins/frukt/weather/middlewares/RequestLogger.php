<?php

namespace Frukt\Weather\middlewares;

use Closure;
use Log;

class RequestLogger
{
    public function handle($request, Closure $next)
    {
        Log::channel('info')->info("{$request->route()->uri()} request from {$request->ip()}");
        return $next($request);
    }
}
