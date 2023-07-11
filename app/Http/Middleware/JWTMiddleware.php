<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

/**
 * class JWTMiddleware
 * @package App\Http\Middleware
 */
class JWTMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = auth()->userOrFail();

            if (!$user) {
                return response()->json([
                    'message' => __('confirmation.unauthenticated')
                ], 401);
            }

        } catch (JWTException $exception) {
            return response()->json([
                'message' => __('confirmation.unauthenticated')
            ], 401);
        }

        return $next($request);
    }
}
