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
class ResponseList extends ResponseData
{

    /**
     * @OA\Property(description="전체 데이터 수량", example=50)
     * @var int
     */
    protected $total_count;

    /**
     * @OA\Property(description="페이지 당 데이터 수량", example=20)
     * @var int
     */
    protected $per_page;

    /**
     * @OA\Property(description="페이지", example=1)
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
     * @param   int                 $perPage
     * @param   int                 $totalCount
     * @param   Collection|array    $results
     */
    function __construct(int $page, int $perPage, int $totalCount, $results)
    {
        $this->success = true;
        $this->page = $page;
        $this->per_page = $perPage;
        $this->total_count = $totalCount;
        $this->results = $results;

        parent::__construct($this->toArray(), 200);
    }

    /**
     * @param   int                 $page
     * @param   int                 $perPage
     * @param   int                 $totalCount
     * @param   Collection|array    $results
     */
    static function new(int $page, int $perPage, int $totalCount, $results)
    {
        return new static($page, $perPage, $totalCount, $results);
    }

    function toArray()
    {
        return [
            "success" => $this->success,
            "page" => $this->page,
            "per_page" => $this->per_page,
            "total_count" => $this->total_count,
            "results" => $this->results,
        ];
    }
}
