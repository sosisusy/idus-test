<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;

/**
 * 유저 토큰 발급
 */
class IssueUserAccessTokenRequest extends BaseRequest
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
    public function rules()
    {
        return [
            "username" => "required|string",
            "password" => "required|string",
        ];
    }

    function withValidator(Validator $validator)
    {
        $validator->after(function (Validator $validator) {
            $user = User::where("username", $this->get("username"))->first();

            if (empty($user) || !Hash::check($this->get("password"), $user->password)) {
                $validator->errors()->add("username", "username 혹은 패스워드를 다시 확인 해주세요.");
                $validator->errors()->add("password", "username 혹은 패스워드를 다시 확인 해주세요.");
            }
        });
    }
}
