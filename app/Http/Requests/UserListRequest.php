<?php

namespace App\Http\Requests;

class UserListRequest extends PageRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->user();

        return $user->tokenCan("users:index");
    }

    function queryRules(): array
    {
        return [
            "email" => "nullable|string",
            "name" => "nullable|string",
        ];
    }
}
