<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('facebook_id')->nullable();
            $table->string('avatar')->nullable();
            $table->string('avatar_original')->nullable();
            $table->string('gender')->nullable();
            $table->string('role')->default('customer');

            $table->string('confirmation_code')->nullable();
            $table->integer('newsletter_subscription')->default(0);
            $table->string('last_online')->nullable();
            
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('social_security_id')->nullable();
            

            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('country')->nullable();

            $table->smallInteger('signed_agreement')->default(0);
            $table->smallInteger('is_email_confirmed')->default(0);

            $table->string('lang')->default('se'); // defaults to Swedish
            $table->string('api_token', 60)->unique();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
