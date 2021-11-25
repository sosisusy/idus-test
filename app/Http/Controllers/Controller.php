<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      title="idus API",
 *      version="0.1",
 *      description="
 Request 인증
 - `/api/token` 엔드포인트에서 인증 토큰을 발급 받을 수 있습니다.
 - Request Header `Authorization` 필드 안에 `bearer <auth-token>` 형태로 인증 토큰을 기입 후 요청해주시면 됩니다.
",
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
