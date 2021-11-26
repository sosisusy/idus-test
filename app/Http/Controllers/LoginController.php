<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Services\UserService;

/**
 * 로그인 컨트롤러
 *
 * @OA\Tag(
 *      name="Login",
 *      description="회원 가입 및 토큰 발급",
 * )
 */
class LoginController extends Controller
{
    protected UserService $userService;

    function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * 회원 가입
     *
     * @OA\Post(
     *      path="/api/register",
     *      tags={"Login"},
     *      description="",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/NewUser",
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="성공",
     *          @OA\JsonContent(
     *              type="object",
     *              allOf={
     *                  @OA\Schema(ref="#/components/schemas/User")
     *              }
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="유효성 검사 실패",
     *          @OA\JsonContent(
     *              type="object",
     *              allOf={
     *                  @OA\Schema(ref="#/components/schemas/ResponseError")
     *              }
     *          )
     *      ),
     * )
     */
    function register(UserRegisterRequest $request)
    {
        $user = $this->userService->create($request);

        return $this->responseObject($user);
    }
}
