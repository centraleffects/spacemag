<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalespotBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('salespot_bookings', function (Blueprint $table) {
            
            $table->increments('id')->unique();

            $table->integer('salespot_id')->unsigned()->index();
            $table->foreign('salespot_id')->references('id')->on('salespots');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');

            $table->dateTime('date_start');
            $table->dateTime('date_end')->nullable();
            $table->decimal('price', 5, 2)->nullable();
            $table->decimal('original_price', 5, 2)->nullable();
            $table->enum('booking_status', ['active','deleted'])->nullable();
            $table->smallInteger('is_paid')->default(0);

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
        Schema::dropIfExists('salespot_bookings');
    }
}