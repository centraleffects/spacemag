<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalespotCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salespot_categories', function (Blueprint $table) {
            
            $table->increments('id')->unique();
            $table->foreign('salespot_id')->references('id')->on('users');
            $table->foreign('category_type_id')->references('id')->on('salespot_category_type');
            $table->foreign('user_id')->references('id')->on('users');        

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
         Schema::dropIfExists('salespot_categories');
    }
}