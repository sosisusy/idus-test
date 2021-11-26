<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class UserService extends Service
{

    /**
     * 회원 목록 조회
     *
     * @param   int     $perPage
     * @param   array   $likes
     *
     * @var     string  $likes[email]
     * @var     string  $likes[name]
     */
    function getUsers(int $perPage, array $likes = []): LengthAwarePaginator
    {
        $query = User::query();

        if (!empty($likes["email"])) $query->where("email", "like", "{$likes["email"]}%");
        if (!empty($likes["name"])) $query->where("name", "like", "{$likes["name"]}%");

        return $query->paginate($perPage);
    }

    /**
     * 회원 생성
     */
    function create(Request $request)
    {
        return DB::transaction(function () use ($request) {
            return User::create(
                [
                    "username" => $request->username,
                    "name" => $request->name,
                    "nickname" => $request->nickname,
                    "password" => $request->password,
                    "phone_number" => $request->phone_number,
                    "email" => $request->email,
                    "gender" => $request->gender,
                ] + [
                    "scope" => []
                ]
            );
        }, 3);
    }

    /**
     * API 접근 토큰 발급
     */
    function issueAccessToken(string $token_name, User $user)
    {
        return $user->createToken($token_name, $user->scope);
    }

    /**
     * 토큰 삭제
     */
    function disposeAccessToken(User $user)
    {
        $user->tokens()->delete();
    }
}
