<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * class ApiVersion
 * @package App\Http\Middleware
 */
class ApiVersion
{
    /**
     * @param Request $request
     * @param Closure $next
     * @param $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard): mixed
    {
        config(['app.api.version' => $guard]);
        return $next($request);
    }
}
