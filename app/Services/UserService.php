<?php

namespace App\Services;

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
}
