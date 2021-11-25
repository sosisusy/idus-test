<?php

namespace App\Classes\Response;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

/**
 * 리스폰 리스트 객체
 *
 * @OA\Schema(
 *      type="object",
 * )
 */
class ResponseList extends ResponseData implements Arrayable
{

    /**
     * @OA\Property()
     * @var Collection|array
     */
    protected $results;

    /**
     * @param   Collection|array    $results
     */
    function __construct($results)
    {
        $this->success = true;
        $this->results = $results;

        parent::__construct($this->toArray(), 400);
    }

    /**
     * @param   Collection|array    $results
     */
    static function new($results)
    {
        return new static($results);
    }

    function toArray()
    {
        return [
            "success" => $this->success,
            "results" => $this->results,
        ];
    }
}
