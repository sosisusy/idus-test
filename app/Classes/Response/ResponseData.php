<?php

namespace App\Classes\Response;

use Illuminate\Http\JsonResponse;

/**
 * 리스폰 데이터
 *
 * @OA\Schema(type="object")
 */
abstract class ResponseData extends JsonResponse
{
    /**
     * @OA\Property()
     */
    protected bool $success;
}
