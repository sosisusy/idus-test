<?php

namespace App\Http\Requests;

/**
 * 페이지 요청
 */
class PageRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    final public function rules()
    {
        return $this->queryRules() + $this->pageRules();
    }

    /**
     * 데이터 조회 룰
     */
    function queryRules(): array
    {
        return [];
    }

    /**
     * 목록 페이지 룰
     */
    function pageRules(): array
    {
        return [
            "page" => "nullable|numeric|min:1",
            "per_page" => "nullable|numeric|between:1,100",
        ];
    }
}
