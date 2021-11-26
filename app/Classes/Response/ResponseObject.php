<?php

namespace App\Classes\Response;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;

/**
 * 리스폰 단일 객체
 *
 * @OA\Schema(
 *      type="object",
 * )
 */
class ResponseObject extends ResponseData implements Arrayable
{

    /**
     * @OA\Property()
     * @var Model|array|object
     */
    protected $result;

    /**
     * @param   Model|array|object    $result
     */
    function __construct($result)
    {
        $this->success = true;
        $this->result = $result;

        parent::__construct($this->toArray(), 200);
    }

    /**
     * @param   Model|array|object    $result
     */
    static function new($result)
    {
        return new static($result);
    }

    function toArray()
    {
        return [
            "success" => $this->success,
            "result" => $this->result,
        ];
    }
}
