<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(schema="NewUser")
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        "updated_at",
    ];

    protected $casts = [];

    /**
     * @OA\Property(example="testuser")
     * @var string
     */
    public $username;

    /**
     * @OA\Property(example="홍길동")
     * @var string
     */
    public $name;

    /**
     * @OA\Property(example="laraveluser")
     * @var string
     */
    public $nickname;

    /**
     * @OA\Property(example="01011112222")
     * @var string
     */
    public $phone_number;

    /**
     * @OA\Property(example="test@example.com")
     * @var string
     */
    public $email;

    /**
     * @OA\Property(example="M")
     * @var string
     */
    public $gender;

    function setPasswordAttribute($value)
    {
        $this->attributes["password"] = Hash::make($value);
    }
}

/**
 * @OA\Schema(schema="UserId", type="integer", format="int64", example=1)
 */

/**
 * @OA\Schema(
 *      schema="User",
 *      allOf={
 *          @OA\Schema(ref="#/components/schemas/NewUser"),
 *          @OA\Schema(
 *              type="object",
 *              @OA\Property(property="id", ref="#/components/schemas/UserId")
 *          )
 *      }
 * )
 */
