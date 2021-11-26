<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueUserAccessTokenRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

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
     *                  @OA\Schema(ref="#/components/schemas/ResponseObject"),
     *                  @OA\Schema(
     *                      type="object",
     *                      @OA\Property(property="result", ref="#/components/schemas/User")
     *                  ),
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

    /**
     * 토큰 발급 (로그인)
     *
     * @OA\Post(
     *      path="/api/token",
     *      tags={"Login"},
     *      description="",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(property="username", type="string"),
     *              @OA\Property(property="password", type="string", format="password"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="성공",
     *          @OA\JsonContent(
     *              type="object",
     *              allOf={
     *                  @OA\Schema(ref="#/components/schemas/ResponseObject"),
     *                  @OA\Schema(
     *                      type="object",
     *                      @OA\Property(
     *                          property="result",
     *                          type="object",
     *                          @OA\Property(property="access_token", description="API 접근 토큰", example="1|s3AnvYQ4k4F56JgjNvq163DTDB4csAoDRDknqp8E")
     *                      )
     *                  )
     *              }
     *          )
     *      ),
     * )
     */
    function issueToken(IssueUserAccessTokenRequest $request)
    {
        $user = User::where("username", $request->get("username"))->first();
        $token = $this->userService->issueAccessToken("user access token", $user);

        return $this->responseObject([
            "access_token" => $token->plainTextToken,
        ]);
    }

    /**
     * 토큰 폐기 (로그아웃)
     *
     * @OA\Get(
     *      path="/api/token/dispose",
     *      tags={"Login"},
     *      security={{"accessToken":{""}}},
     *      description="",
     *      @OA\Response(
     *          response=204,
     *          description="No Content",
     *      ),
     * )
     */
    function disposeToken(Request $request)
    {
        $user = $request->user();
        $this->userService->disposeAccessToken($user);

        return response("", 204);
    }
}
