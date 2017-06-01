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
        if( !Schema::hasTable('salespot_categories') )
        
        Schema::create('salespot_categories', function (Blueprint $table) {
            
            $table->increments('id')->unique();

            $table->integer('salespot_id')->unsigned()->index();
            $table->foreign('salespot_id')->references('id')->on('salespots');

            $table->integer('category_type_id')->unsigned()->index();
            $table->foreign('category_type_id')->references('id')->on('salespot_category_types');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');        

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
         Schema::dropIfExists('salespot_categories');
    }
}