<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @OA\Tag(name="User", description="회원")
 */
class UserController extends Controller
{
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
