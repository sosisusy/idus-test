<?php

namespace App\Http\Requests;

use App\Classes\Response\ResponseError;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class BaseRequest extends FormRequest
{

    /**
     * 유효성 검사 실패
     *
     * @throws \lluminate\Http\Exceptions\HttpResponseException
     */
    function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ResponseError::new(
                "유효성 검사에 실패했습니다.",
                $validator->errors()
            )
        );
    }
}
