<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @OA\Tag(name="Order", description="주문")
 */
class OrderController extends Controller
{
    /**
     * 주문 건 조회
     *
     * @OA\Get(
     *      path="/api/orders",
     *      tags={"Order"},
     *      security={{"accessToken":{""}}},
     *      description="",
     *      @OA\Parameter(
     *          name="page",
     *          in="query",
     *          required=false,
     *          allowEmptyValue=true,
     *          description="페이지",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Parameter(
     *          name="count",
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
     *                      @OA\Property(property="results", type="array", @OA\Items(ref="#/components/schemas/Order"))
     *                  ),
     *              }
     *          )
     *      ),
     * )
     */
    public function index(Request $request)
    {
        // $page = $request->get("page", 1);
        // $count = $request->get("count", 20);

        $user = $request->user();
        $orders = $user->orders()->latest()->paginate(20);

        // return $this->responseList($orders);
    }
}
