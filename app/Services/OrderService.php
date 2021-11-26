<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * 주문 서비스
 */
class OrderService extends Service
{

    /**
     * 주문 목록 조회
     */
    function getOrders(User $user, int $perPage): LengthAwarePaginator
    {
        return $user->orders()->latest()->paginate($perPage);
    }
}
