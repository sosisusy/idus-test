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
     * @OA\Property(description="전체 데이터 수량")
     * @var int
     */
    protected $totalCount;

    /**
     * @OA\Property(description="페이지 당 데이터 수량")
     * @var int
     */
    protected $rowCount;

    /**
     * @OA\Property(description="페이지")
     * @var int
     */
    protected $page;

    /**
     * @OA\Property(description="결과 값")
     * @var Collection|array
     */
    protected $results;

    /**
     * @param   int                 $page
     * @param   int                 $rowCount
     * @param   int                 $totalCount
     * @param   Collection|array    $results
     */
    function __construct(int $page, int $rowCount, int $totalCount, $results)
    {
        $this->success = true;
        $this->page = $page;
        $this->rowCount = $rowCount;
        $this->totalCount = $totalCount;
        $this->results = $results;

        parent::__construct($this->toArray(), 400);
    }

    /**
     * @param   int                 $page
     * @param   int                 $rowCount
     * @param   int                 $totalCount
     * @param   Collection|array    $results
     */
    static function new(int $page, int $rowCount, int $totalCount, $results)
    {
        return new static($page, $rowCount, $totalCount, $results);
    }

    function toArray()
    {
        return [
            "success" => $this->success,
            "page" => $this->page,
            "rowCount" => $this->rowCount,
            "totalCount" => $this->totalCount,
            "results" => $this->results,
        ];
    }
}
