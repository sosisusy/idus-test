<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(schema="NewUser", description="신규 유저")
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
     * @OA\Property(description="로그인 네임", example="testuser")
     * @var string
     */
    protected $username;

    /**
     * @OA\Property(description="회원명", example="홍길동")
     * @var string
     */
    protected $name;

    /**
     * @OA\Property(description="패스워드", example="qdw12312A3!3")
     * @var string
     */
    protected $password;

    /**
     * @OA\Property(description="별칭", example="laraveluser")
     * @var string
     */
    protected $nickname;

    /**
     * @OA\Property(description="전화 번호", example="01011112222")
     * @var string
     */
    protected $phone_number;

    /**
     * @OA\Property(description="이메일", example="test@example.com")
     * @var string
     */
    protected $email;

    /**
     * @OA\Property(description="성별<br>`M`: 남성, `F`: 여성", enum={"M", "F"}, example="M")
     * @var string
     */
    protected $gender;

    function setPasswordAttribute($value)
    {
        $this->attributes["password"] = Hash::make($value);
    }
}

/**
 * @OA\Schema(schema="UserId", description="회원 고유 아이디", type="integer", format="int64", example=1)
 */

/**
 * @OA\Schema(
 *      schema="User",
 *      description="회원 정보",
 *      allOf={
 *          @OA\Schema(ref="#/components/schemas/NewUser"),
 *          @OA\Schema(
 *              type="object",
 *              @OA\Property(property="id", ref="#/components/schemas/UserId")
 *          )
 *      },
 *      not={"password"}
 * )
 */
