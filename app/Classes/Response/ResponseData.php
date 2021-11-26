<?php

namespace App\Classes\Response;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Http\JsonResponse;

/**
 * 리스폰 데이터
 *
 * @OA\Schema(
 *      type="object",
 * )
 */
abstract class ResponseData extends JsonResponse implements Jsonable, Arrayable
{
    /**
     * @OA\Property()
     */
    protected bool $success;

    function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }

        return null;
    }

    function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options | JSON_UNESCAPED_UNICODE);
    }
}
