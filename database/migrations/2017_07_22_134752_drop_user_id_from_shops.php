<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUserIdFromShops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('shops', 'user_id'))
            {
                Schema::table('shops', function(Blueprint $table) {

                    DB::connection()->getPdo()->exec('ALTER TABLE `shops` DROP FOREIGN KEY `shops_user_id_foreign`;');
                    DB::connection()->getPdo()->exec('ALTER TABLE `shops` DROP `user_id`;');
                    
                });
            }
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
