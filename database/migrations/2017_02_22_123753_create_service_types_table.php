<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if( !Schema::hasTable('service_types'))  

         Schema::create('service_types', function (Blueprint $table) {
            
            $table->increments('id')->unique();

            $table->string('name');
            $table->longText('description')->nullable();
            $table->decimal('price_per_day', 5, 2)->nullable();
            $table->decimal('price_per_week', 5, 2)->nullable();
            $table->smallInteger('is_active')->default(0);

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
         Schema::dropIfExists('service_types');
    }
}