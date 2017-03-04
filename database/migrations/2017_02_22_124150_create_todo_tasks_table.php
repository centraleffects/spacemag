<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodoTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('todo_tasks', function (Blueprint $table) {
            
            $table->increments('id')->unique();

            $table->integer('service_type_id')->unsigned()->index();
            $table->foreign('service_type_id')->references('id')->on('service_types'); 

            $table->integer('salespot_id')->unsigned()->index();
            $table->foreign('salespot_id')->references('id')->on('salespots');

            $table->integer('worker_user_id')->unsigned()->index();
            $table->foreign('worker_user_id')->references('id')->on('users');

            $table->integer('service_booking_id')->unsigned()->index();
            $table->foreign('service_booking_id')->references('id')->on('shop_services_bookings');  

            $table->longText('description')->nullable();
            $table->smallInteger('status')->default(1);
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
         Schema::dropIfExists('todo_tasks');
    }
}