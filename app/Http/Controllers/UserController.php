<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserListRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(name="User", description="회원")
 */
class UserController extends Controller
{
    protected UserService $userService;

    function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * 회원 목록 조회
     *
     * @OA\Get(
     *      path="/api/users",
     *      tags={"User"},
     *      security={{"accessToken":{""}}},
     *      description="",
     *      @OA\Parameter(
     *          name="email",
     *          in="query",
     *          required=false,
     *          allowEmptyValue=true,
     *          description="이메일 검색",
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          in="query",
     *          required=false,
     *          allowEmptyValue=true,
     *          description="회원명 검색",
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="page",
     *          in="query",
     *          required=false,
     *          allowEmptyValue=true,
     *          description="페이지",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *          name="per_page",
     *          in="query",
     *          required=false,
     *          allowEmptyValue=true,
     *          description="페이지 당 데이터 수량",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="성공",
     *          @OA\JsonContent(
     *              type="object",
     *              allOf={
     *                  @OA\Schema(ref="#/components/schemas/ResponseList"),
     *                  @OA\Schema(
     *                      type="object",
     *                      @OA\Property(
     *                          property="results",
     *                          type="array",
     *                          @OA\Items(
     *                              type="object",
     *                              allOf={
     *                                  @OA\Schema(ref="#/components/schemas/User"),
     *                                  @OA\Schema(
     *                                      type="object",
     *                                      @OA\Property(property="last_order", ref="#/components/schemas/Order")
     *                                  )
     *                              }
     *                          )
     *                      )
     *                  ),
     *              }
     *          )
     *      ),
     * )
     */
    function index(UserListRequest $request)
    {
        $perPage = $request->get("per_page", 20);
        $users = $this->userService->getUsers($perPage, [
            "email" => $request->get("email"),
            "name" => $request->get("name"),
        ]);

        return $this->responseList($users);
    }

    /**
     * 사용자 정보 조회
     *
     * @OA\Get(
     *      path="/api/me",
     *      tags={"User"},
     *      security={{"accessToken":{""}}},
     *      description="",
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
    function me(Request $request)
    {
        return $this->responseObject($request->user());
    }
}
