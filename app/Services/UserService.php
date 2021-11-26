<?php

namespace App\Services;

use App\Http\Requests\IssueUserAccessTokenRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserService extends Service
{

    /**
     * 회원 생성
     */
    function create(Request $request)
    {
        return DB::transaction(function () use ($request) {
            return User::create($request->all());
        }, 3);
    }

    /**
     * API 접근 토큰 발급
     */
    function issueAccessToken(string $token_name, User $user)
    {
        return $user->createToken($token_name);
    }

    /**
     * 토큰 삭제
     */
    function disposeAccessToken(User $user)
    {
        $user->tokens()->delete();
    }
}
