<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('user_billing_details', function (Blueprint $table) {
            
            $table->increments('id')->unique();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('zipcode', 10)->nullable();
            $table->string('country',5)->nullable();

            $table->string('bank_account_name')->nullable();
            $table->string('bank_account_no')->nullable();

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
         Schema::dropIfExists('user_billing_details');
    }
}