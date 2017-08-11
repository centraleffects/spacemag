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
        if( !Schema::hasTable('todo_tasks') )
        
         Schema::create('todo_tasks', function (Blueprint $table) {
            
            $table->increments('id')->unique();

            $table->integer('service_type_id')->unsigned()->index()->nullable();
            $table->foreign('service_type_id')->references('id')->on('service_types'); 

            $table->integer('salespot_id')->unsigned()->index()->nullable();
            $table->foreign('salespot_id')->references('id')->on('salespots');

            // task assignee
            $table->integer('worker_user_id')->unsigned()->index()->nullable();
            $table->foreign('worker_user_id')->references('id')->on('users');

            // task author
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');

            // this column is only fillable when the task is a TodoList (which is an exclusive task created
            //    automatically by the 5 static services: on which this task is assigned to no one but the shop workers 
            //    that the specific salespot is belonged to)
            $table->integer('completed_by_user_id')->unsigned()->index()->nullable();
            $table->foreign('completed_by_user_id')->references('id')->on('users');

            // this field will be used if Salespot is not or not yet specified. 
            // If a Salespot is specified, this field will become null.
            $table->integer('shop_id')->unsigned()->index()->nullable();
            $table->foreign('shop_id')->references('id')->on('shops');

            $table->integer('service_booking_id')->unsigned()->index()->nullable();
            $table->foreign('service_booking_id')->references('id')->on('shop_services_bookings');  

            $table->longText('description')->nullable();
            $table->enum('status', ['pristine', 'in-progress', 'finished'])->default('pristine');
            $table->boolean('done')->default(false); // 1 if done, 0 if not done
            $table->dateTime('date_started')->nullable();
            $table->dateTime('date_finished')->nullable();

            $table->timestamps();
            $table->softDeletes();
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