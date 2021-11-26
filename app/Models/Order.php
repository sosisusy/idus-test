<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(schema="NewOrder", description="신규 주문 건")
 */
class Order extends Model
{
    protected $guarded = [];

    /**
     * @OA\Property(description="회원 고유 아이디", example=1)
     * @var int
     */
    protected $user_id;

    /**
     * @OA\Property(description="주문 번호", example="order1")
     * @var string
     */
    protected $order_number;

    /**
     * @OA\Property(description="제품명", example="세탁기")
     * @var string
     */
    protected $product_name;

    /**
     * @OA\Property(description="결제 일시", type="string", format="datetime", example="2021-11-26 12:00:00")
     * @var string
     */
    protected $payment_dt;

    /**
     * 회원
     */
    function user()
    {
        return $this->belongsTo(User::class);
    }
}

/**
 * @OA\Schema(schema="OrderId", description="주문 건 고유 아이디", type="integer", format="int64", example=1)
 */

/**
 * @OA\Schema(
 *      schema="Order",
 *      description="주문 건 정보",
 *      allOf={
 *          @OA\Schema(ref="#/components/schemas/NewOrder"),
 *          @OA\Schema(
 *              type="object",
 *              @OA\Property(property="id", ref="#/components/schemas/OrderId")
 *          )
 *      },
 * )
 */
