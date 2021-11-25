<?php

namespace App\Classes\Response;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

/**
 * 리스폰 에러 객체
 *
 * @OA\Schema(type="object")
 */
class ResponseError extends ResponseData implements Jsonable, Arrayable
{

    /**
     * @OA\Property()
     */
    protected string $message;

    /**
     * @OA\Property(type="array", @OA\Items(type="object"))
     */
    protected $errors;

    function __construct(string $message, $errors)
    {
        $this->success = false;
        $this->message = $message;
        $this->errors = $errors;

        parent::__construct($this->toArray());
    }

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

    function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options | JSON_UNESCAPED_UNICODE);
    }

    function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }

        return null;
    }
}
