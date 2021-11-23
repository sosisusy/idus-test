<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->foreignId("user_id")->comment("회원 아이디");
            $table->string("order_number", 12)->comment("주문 번호");
            $table->string("product_name", 100)->comment("제품명");
            $table->dateTime("payment_dt")->comment("결제 일시");
            $table->timestamps();

            $table->unique("order_number");
        });

        DB::statement("ALTER TABLE orders COMMENT '주문 테이블'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
