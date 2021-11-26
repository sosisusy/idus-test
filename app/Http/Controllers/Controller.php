<?php

namespace App\Http\Controllers;

use App\Classes\Response\ResponseError;
use App\Classes\Response\ResponseList;
use App\Classes\Response\ResponseObject;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      title="idus API",
 *      version="0.1",
 *      description="
 ## Request 인증
 - `/api/token` 엔드포인트에서 인증 토큰을 발급 받을 수 있습니다.
 - Request Header `Authorization` 필드 안에 `Bearer <access-token>` 형태로 인증 토큰을 기입 후 요청해주시면 됩니다.

 ## Access Token
 - 유지시간: `inf`

 ## 유효성 검사 실패
 - Response Code: 400
 - Response Body: `ResponseError`
 ```json
 {
    'success': false,
    'message': '유효성 검사에 실패했습니다.',
    'errors': {
        'username': [
            '이미 존재하는 username 입니다.'
        ]
    }
}
 ```
",
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 단일 데이터 리스폰
     *
     * @param   Model|array|object  $result
     */
    function responseObject($result)
    {
        return ResponseObject::new($result);
    }

    /**
     * 목록형 데이터 리스폰
     *
     * @param   LengthAwarePaginator    $results
     */
    function responseList(LengthAwarePaginator $results)
    {
        return ResponseList::new(
            $results->currentPage(),
            $results->perPage(),
            $results->total(),
            $results->items()
        );
    }

    /**
     * 에러 리스폰
     *
     * @param   string              $message
     * @param   array|MessageBag    $errors
     */
    function responseError(string $message, $errors)
    {
        return ResponseError::new($message, $errors);
    }
}
