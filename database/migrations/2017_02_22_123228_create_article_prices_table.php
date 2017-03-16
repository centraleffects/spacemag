<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned()->index();
            $table->foreign('article_id')->references('id')->on('articles');
            
            $table->decimal('price', 5,2)->nullable();
            $table->decimal('original_price', 5,2)->nullable();
            $table->decimal('quantity', 5,2)->nullable();
            
            $table->smallInteger('sold_in_pieces')->default(0);

            $table->enum('status', ['draft', 'printed', 'sold', 'deleted'])->default('draft');

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
        Schema::dropIfExists('article_prices');
    }
}
