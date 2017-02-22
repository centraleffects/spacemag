<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleLablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('article_labels', function (Blueprint $table) {
            
            $table->increments('id')->unique();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('article_id')->references('id')->on('articles');
            $table->foreign('salespot_id')>references('id')->on('salespots');
            $table->foreign('media_type_id')->references('id')->on('label_media_type');        

            $table->string('filename');
            $table->enum('status', ["draft", "ready to print", "printed", "deleted"])->default("draft");

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
         Schema::dropIfExists('article_labels');
    }
}