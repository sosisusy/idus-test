<?php

namespace App\Classes\Response;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\MessageBag;

/**
 * 리스폰 에러 객체
 *
 * @OA\Schema(
 *      type="object",
 *      example={
 *          "success": false,
 *          "message": "유효성 검사에 실패했습니다.",
 *          "errors": {
 *              "username": {
 *                  "username 값이 6 ~ 25 글자가 아닙니다."
 *              },
 *          }
 *      },
 * )
 */
class ResponseError extends ResponseData implements Arrayable
{

    /**
     * @OA\Property()
     */
    protected string $message;

    /**
     * @OA\Property()
     * @var array|MessageBag
     */
    protected $errors;

    /**
     * @param   string              $message
     * @param   array|MessageBag    $errors
     */
    function __construct(string $message, $errors)
    {
        $this->success = false;
        $this->message = $message;
        $this->errors = $errors;

        parent::__construct($this->toArray(), 400);
    }

    /**
     * @param   string              $message
     * @param   array|MessageBag    $errors
     */
    static function new(string $message, $errors)
    {
        return new static($message, $errors);
    }

    function toArray()
    {
        return [
            "success" => $this->success,
            "message" => $this->message,
            "errors" => $this->errors,
        ];
    }
}
