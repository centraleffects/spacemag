<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopServicesBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('shop_services_booking', function (Blueprint $table) {
            
            $table->increments('id')->unique();
            $table->integer('salespot_id')->unsigned()->index();
            $table->foreign('salespot_id')->references('id')->on('salespots');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('service_type_id')->unsigned()->index();
            $table->foreign('service_type_id')->references('id')->on('service_types');
           
            $table->longText('notes')->nullable();
            $table->enum('status', ['active', 'completed', 'deleted'])->default('active');
            $table->dateTime('date_start')->nullable();
            $table->dateTime('date_end')->nullable();

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
         Schema::dropIfExists('shop_services_booking');
    }
}