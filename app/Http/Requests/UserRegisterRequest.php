<?php

namespace App\Http\Requests;

use App\Rules\PasswordRule;

class UserRegisterRequest extends BaseRequest
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
            "username" => "required|regex:/^[a-z0-9_]+$/|between:6,25",
            "name" => "required|alpha|between:2,20",
            "nickname" => "required|regex:/^[a-z]+$/|between:3,30",
            "password" => ["required", new PasswordRule],
            "phone_number" => "required|regex:/^\d+$/|between:9,20",
            "email" => "required|email",
            "gender" => "nullable|in:M,F",
        ];
    }

    function messages()
    {
        return [
            "username.regex" => ":attribute 값은 영문 소문자, 숫자, _ 만 입력 할 수 있습니다.",
            "nickname.regex" => ":attribute는 소문자만 입력 가능합니다.",
            "phone_number.regex" => ":attribute는 숫자만 입력 할 수 있습니다.",
            "gender.in" => ":attribute의 값은 M, F 만 입력 할 수 있습니다.",
        ];
    }

    function attributes()
    {
        return [
            "name" => "이름",
            "nickname" => "별칭",
            "password" => "패스워드",
            "phone_number" => "전화번호",
            "email" => "이메일",
            "gender" => "성별",
        ];
    }
}
