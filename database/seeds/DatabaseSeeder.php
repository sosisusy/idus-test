<?php

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::updateOrCreate(
            [
                "username" => "test",
            ],
            [
                "name" => "테스트유저",
                "nickname" => "유저닉네임",
                "password" => "test123",
                "phone_number" => "01012341234",
                "email" => "test@test.com",
                "gender" => "M",
            ]
        );

        $user->orders()->saveMany(factory(Order::class, 10)->make());
    }
}
