<?php

namespace App\Http\Controllers\Api\v1\Auth;


use App\Entities\User\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginUserRequest;
use App\Renderer\User\UserRenderer;
use Illuminate\Http\JsonResponse;

/**
 * class AuthController
 * @package App\Http\Controllers\Api\v1\Auth
 * https://github.com/PHP-Open-Source-Saver/jwt-auth
 * https://blog.logrocket.com/implementing-jwt-authentication-laravel-9/
 */
class AuthController extends Controller
{
    const ENTITY = 'User';

    /**
     * @param string $token
     * @return JsonResponse
     */
    protected function createNewToken(string $token): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => $this->userRenderer->render($user),
        ]);
    }

    /**
     * @param UserRenderer $userRenderer
     */
    public function __construct(private UserRenderer $userRenderer)
    {
    }

    /**
     * @param LoginUserRequest $request
     * @return JsonResponse
     */
    public function authenticate(LoginUserRequest $request): JsonResponse
    {
        $credentials = $request->only('emailAddress', 'password');

        if ($token = auth()->attempt($credentials)) {
            return $this->createNewToken($token);
        }

        return response()->json([
            'status' => 401,
            'message' => __('confirmation.invalid-login'),
        ], 401);
    }

    /**
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        try {
            return $this->createNewToken(auth()->refresh());
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'message' => $exception->getMessage(),
            ], 500);
        }

    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json([
            'status' => 200,
            'message' => __('confirmation.logout', ['entity' => self::ENTITY]),
        ], 200);
    }
}
