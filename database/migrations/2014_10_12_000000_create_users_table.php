<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->string("username", 30)->comment("회원 고유 네임");
            $table->string('name', 20)->comment("이름");
            $table->string('nickname', 30)->comment("별칭");
            $table->string('password', 100)->comment("비밀번호");
            $table->string('phone_number', 20)->comment("연락처");
            $table->string('email', 100)->comment("이메일");
            $table->enum("gender", ["M", "F"])->nullable()->comment("성별 (M: 남, F: 여)");
            $table->timestamps();

            $table->unique("username");
        });

        DB::statement("ALTER TABLE users COMMENT '회원 테이블'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
