<?php

// namespace Tests\Unit;

// use Tests\TestCase;
// use Illuminate\Foundation\Testing\DatabaseMigrations;
// use Illuminate\Foundation\Testing\DatabaseTransactions;

// use App\User;
// use App\Shop;

// class ShopTest extends TestCase
// {

// 	protected $user;
    
//     function __construct()
//     {
//         User::create([
//         	'id' => 1,
//         	'first_name' => 'John',
// 			'last_name' => 'Doe',
// 			'email' => 'JohnDoe@example.com',
// 			'password' => 'secret',
// 			'facebook_id' => null,
// 			'type' => 'customer',
// 			'confirmation_code' => null,
// 			'newsletter_subscription' => 0,
// 			'last_online' => null,
// 			'telephone' => null,
// 			'mobile' => null,
// 			'social_security_id' => null,
// 			'address_1' => null,
// 			'address_2' => null,
// 			'city' => null,
// 			'zip_code' => null,
// 			'signed_agreement' => 0,
// 			'is_email_confirmed' => 0
//         ]);


//         Shop::create([
//     		'id' => 1,
//     		'user_id' => $this->user->id,
//         	'name' => 'PureFoods Hotdog',
// 			'description' => 'Something that describes this shop',
// 			'url' => null,
// 			'currency' => 'PHP'
//     	]);

//     }

//     /** @test */
//     public function a_shop_has_an_owner(){
//     	$user =  User::all();
//         // $shop = Shop::find(1);
//         var_dump($user);
//     	// $this->assertEquals(1, $shop->user->id);
//         $this->assertTrue(true);
//     }
// }
