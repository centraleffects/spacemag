<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( !Schema::hasTable('article_category') )
        
        Schema::create('article_category', function (Blueprint $table) {
            
            $table->increments('id')->unique();

            $table->integer('article_id')->unsigned()->index();
            $table->foreign('article_id')->references('id')->on('articles');

            // $table->integer('category_id')->unsigned()->index();
            $table->integer('salespot_category_type_id')->unsigned()->index();
            // $table->foreign('category_id')->references('id')->on('salespot_categories');
            // $table->foreign('category_id')->references('id')->on('salespot_categories_types');
            $table->foreign('salespot_category_type_id')->references('id')->on('salespot_category_types')
                ->onDelete('cascade');

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
        //
    }
}
