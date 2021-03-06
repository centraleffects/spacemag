<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	/* admin */
        App\User::create([
			"id" => 1,
			"first_name" => "Dex",
			"last_name" => "Bengil",
			"email" => "dexterb2992@gmail.com",
			"password" => bcrypt("dexter"),
			"facebook_id" => null,
			"avatar" => null,
			"avatar_original" => null,
			"gender" => null,
			"role" => "admin",
			"confirmation_code" => null,
			"newsletter_subscription" => 0,
			"last_online" => null,
			"telephone" => null,
			"mobile" => null,
			"social_security_id" => null,
			"address_1" => null,
			"address_2" => null,
			"city" => null,
			"zip_code" => null,
			"signed_agreement" => 0,
			"is_email_confirmed" => 0,
			"lang" => "sv",
			"api_token" => str_random(60),
			"created_at" => "2017-03-22 04:06:59",
			"updated_at" => "2017-03-22 04:06:59",
			"deleted_at" => null,
		]);

		/* owner */
        App\User::create([
			"id" => 2,
			"first_name" => "Dexter",
			"last_name" => "Bengil",
			"email" => "dexter_bengil@hotmail.com",
			"password" => bcrypt("dexter"),
			"facebook_id" => "1356313041092446",
			"avatar" => "https://graph.facebook.com/v2.8/1356313041092446/picture?type=normal",
			"avatar_original" => "https://graph.facebook.com/v2.8/1356313041092446/picture?width=1920",
			"gender" => "male",
			"role" => "owner",
			"confirmation_code" => null,
			"newsletter_subscription" => 0,
			"last_online" => null,
			"telephone" => null,
			"mobile" => null,
			"social_security_id" => null,
			"address_1" => "Dexter Bengil",
			"address_2" => null,
			"city" => null,
			"zip_code" => null,
			"signed_agreement" => 0,
			"is_email_confirmed" => 0,
			"lang" => "sv",
			"api_token" => str_random(60),
			"created_at" => "2017-03-22 07:20:35",
			"updated_at" => "2017-03-24 05:49:37",
			"deleted_at" => null,
        ]);


        /* customers */
        App\User::create([
			"id" => 3,
			"first_name" => "John",
			"last_name" => "Doe",
			"email" => "johndoe@hotmail.com",
			"password" => bcrypt("dexter"),
			"facebook_id" => null,
			"avatar" => "https://graph.facebook.com/v2.8/1356313041092446/picture?type=normal",
			"avatar_original" => "https://graph.facebook.com/v2.8/1356313041092446/picture?width=1920",
			"gender" => "male",
			"role" => "customer",
			"confirmation_code" => null,
			"newsletter_subscription" => 0,
			"last_online" => null,
			"telephone" => null,
			"mobile" => null,
			"social_security_id" => null,
			"address_1" => "Cabantian",
			"address_2" => null,
			"city" => null,
			"zip_code" => null,
			"signed_agreement" => 0,
			"is_email_confirmed" => 0,
			"lang" => "sv",
			"api_token" => str_random(60),
			"created_at" => "2017-03-22 07:20:35",
			"updated_at" => "2017-03-24 05:49:37",
			"deleted_at" => null,
        ]);

        App\User::create([
			"id" => 4,
			"first_name" => "Johnny",
			"last_name" => "Doer",
			"email" => "johnnydoer@hotmail.com",
			"password" => bcrypt("dexter"),
			"facebook_id" => null,
			"avatar" => "https://graph.facebook.com/v2.8/1356313041092446/picture?type=normal",
			"avatar_original" => "https://graph.facebook.com/v2.8/1356313041092446/picture?width=1920",
			"gender" => "male",
			"role" => "customer",
			"confirmation_code" => null,
			"newsletter_subscription" => 0,
			"last_online" => null,
			"telephone" => null,
			"mobile" => null,
			"social_security_id" => null,
			"address_1" => "Cabantian",
			"address_2" => null,
			"city" => null,
			"zip_code" => null,
			"signed_agreement" => 0,
			"is_email_confirmed" => 0,
			"lang" => "sv",
			"api_token" => str_random(60),
			"created_at" => "2017-03-22 07:20:35",
			"updated_at" => "2017-03-24 05:49:37",
			"deleted_at" => null,
        ]);
    
        /* workers */
        App\User::create([
			"id" => 5,
			"first_name" => "Jenny",
			"last_name" => "Doer",
			"email" => "jennydoer@hotmail.com",
			"password" => bcrypt("dexter"),
			"facebook_id" => null,
			"avatar" => "https://graph.facebook.com/v2.8/1356313041092446/picture?type=normal",
			"avatar_original" => "https://graph.facebook.com/v2.8/1356313041092446/picture?width=1920",
			"gender" => "female",
			"role" => "worker",
			"confirmation_code" => null,
			"newsletter_subscription" => 0,
			"last_online" => null,
			"telephone" => null,
			"mobile" => null,
			"social_security_id" => null,
			"address_1" => "Cabantian",
			"address_2" => null,
			"city" => null,
			"zip_code" => null,
			"signed_agreement" => 0,
			"is_email_confirmed" => 0,
			"lang" => "sv",
			"api_token" => str_random(60),
			"created_at" => "2017-03-22 07:20:35",
			"updated_at" => "2017-03-24 05:49:37",
			"deleted_at" => null,
        ]);

        App\User::create([
			"id" => 6,
			"first_name" => "Jean",
			"last_name" => "Doe",
			"email" => "jeandoe@hotmail.com",
			"password" => bcrypt("dexter"),
			"facebook_id" => null,
			"avatar" => "https://graph.facebook.com/v2.8/1356313041092446/picture?type=normal",
			"avatar_original" => "https://graph.facebook.com/v2.8/1356313041092446/picture?width=1920",
			"gender" => "female",
			"role" => "worker",
			"confirmation_code" => null,
			"newsletter_subscription" => 0,
			"last_online" => null,
			"telephone" => null,
			"mobile" => null,
			"social_security_id" => null,
			"address_1" => "Cabantian",
			"address_2" => null,
			"city" => null,
			"zip_code" => null,
			"signed_agreement" => 0,
			"is_email_confirmed" => 0,
			"lang" => "sv",
			"api_token" => str_random(60),
			"created_at" => "2017-03-22 07:20:35",
			"updated_at" => "2017-03-24 05:49:37",
			"deleted_at" => null,
        ]);
    }
}
