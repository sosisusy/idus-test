<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// 회원 가입
Route::post('register', [LoginController::class, "register"])->name("register");

// 토큰 발급 (login)
Route::post("token", [LoginController::class, "issueToken"])->name("token.issue");

/**
 * 회원 권한
 */
Route::group(["middleware" => ["auth:sanctum"]], function () {

    // 토큰 폐기 (logout)
    Route::get("token/dispose", [LoginController::class, "disposeToken"])->name("token.dispose");

    // 사용자 정보
    Route::get("me", [UserController::class, "me"])->name("me");

    // 회원 목록 조회
    Route::get("users", [UserController::class, "index"])->name("users");

    // 주문 목록 조회
    Route::get("orders", [OrderController::class, "index"])->name("orders");
});
