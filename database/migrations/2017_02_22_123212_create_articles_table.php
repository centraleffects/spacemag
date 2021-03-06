<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( !Schema::hasTable('articles'))  

         Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('quantity', 5, 2)->nullable();
            $table->boolean('sold_in_bulk')->default(0);
            $table->boolean('sold_in_pieces')->default(0);
            $table->string('unit')->nullable();
            $table->string('type')->nullable();
            $table->string('sample_picture')->nullable();

            $table->string('color')->nullable();
            
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
        Schema::dropIfExists('articles');
    }
}
