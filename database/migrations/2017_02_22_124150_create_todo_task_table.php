<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodoTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('todo_task', function (Blueprint $table) {
            
            $table->increments('id')->unique();
            $table->foreign('service_type_id')->references('id')->on('service_types'); 
            $table->foreign('salespot_id')->references('id')->on('salespots');
            $table->foreign('user_id_worker')->references('id')->on('users');
            $table->foreign('service_booking_id')->references('id')->on('shop_services_booking'); 
            $table->foreign('shop_id')->references('id')->on('shops');     

            $table->longText('description')->nullable();
            $table->smallInteger('status', 1)->default(1);
            $table->dateTime('date_started')->nullable();
            $table->dateTime('date_finished')->nullable();

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
         Schema::dropIfExists('todo_task');
    }
}