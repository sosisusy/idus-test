<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;

/**
 * @OA\Tag(name="Order", description="주문")
 */
class OrderController extends Controller
{
    protected OrderService $orderService;

    function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * 주문 목록 조회
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
     *                      @OA\Property(property="results", type="array", @OA\Items(ref="#/components/schemas/Order"))
     *                  ),
     *              }
     *          )
     *      ),
     * )
     */
    public function index(PageRequest $request)
    {
        $perPage = $request->get("per_page", 20);
        $user = $request->user();
        $orders = $this->orderService->getOrders($user, $perPage);

        return $this->responseList($orders);
    }
}
