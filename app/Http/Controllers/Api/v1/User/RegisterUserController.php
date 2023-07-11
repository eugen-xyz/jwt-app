<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RegisterUserRequest;
use App\Renderer\User\UserRenderer;
use App\Services\UserService\RegisterUserService\RegisterUserService;
use ArgumentCountError;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\JsonResponse;

/**
 * class RegisterUserController
 * @package App\Http\Controllers\Api\v1\User
 */
class RegisterUserController extends Controller
{
    const ENTITY = 'User';

    /**
     * @param string $message
     * @return JsonResponse
     */
    private function exception(string $message): JsonResponse
    {
        return response()->json([
            'status' => 422,
            'message' => __('confirmation.not-registered', ['entity' => self::ENTITY]),
            'trace' => $message,
        ], 422);
    }

    /**
     * @param EntityManager $entityManager
     * @param RegisterUserService $registerUserService
     * @param UserRenderer $userRenderer
     */
    public function __construct(private EntityManager       $entityManager,
                                private RegisterUserService $registerUserService,
                                private UserRenderer        $userRenderer
    )
    {
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json("hello world");
    }

    /**
     * @param RegisterUserRequest $request
     * @return JsonResponse
     */
    public function store(RegisterUserRequest $request): JsonResponse
    {
        try {
            $user = $this->registerUserService->handle($request);

            $this->entityManager->flush();

            return response()->json([
                'status' => 201,
                'message' => __('confirmation.registered', ['entity' => self::ENTITY]),
                'data' => $this->userRenderer->render($user),
            ], 201);

        } catch (\Exception $exception) {
            return $this->exception($exception->getMessage());

        } catch (ArgumentCountError $exception) {
            return $this->exception($exception->getMessage());
        }
    }
}
