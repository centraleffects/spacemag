<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('shop_coupons', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->foreign('shop_id')->references('id')->on('shops');
           
            $table->enum('type', ['amount', 'percent'])->default('amount');
            $table->decimal('value', 5, 2)->nullable();
            $table->string('date_start')->nullable();
            $table->string('date_end')->nullable();
            $table->smallInteger('is_active',1)->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('shop_coupons');
    }
}