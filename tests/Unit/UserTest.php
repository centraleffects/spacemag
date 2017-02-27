<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;
use App\Shop;

class UserTest extends TestCase
{

	protected $user, $shop;

    function __construct()
    {
        $this->setUp();
    }
    
    function setUp()
    {
        $user = new User([
        	'id' => 1,
        	'first_name' => 'John',
			'last_name' => 'Doe',
			'email' => 'JohnDoe@example.com',
			'password' => 'secret',
			'facebook_id' => null,
			'type' => 'customer',
			'confirmation_code' => null,
			'newsletter_subscription' => 0,
			'last_online' => null,
			'telephone' => null,
			'mobile' => null,
			'social_security_id' => null,
			'address_1' => null,
			'address_2' => null,
			'city' => null,
			'zip_code' => null,
			'signed_agreement' => 0,
			'is_email_confirmed' => 0
        ]);

        $user = User::find(1);
        $shop = new Shop([
            'id' => 2,
            'user_id' => $user->id,
            'name' => 'PureFoods Hotdog2',
            'description' => 'Something that describes this shop',
            'url' => null,
            'currency' => 'USD'
        ]);
        $user->shops()->save($shop);

        $shop = new Shop([
            'id' => 2,
            'user_id' => $user->id,
            'name' => 'PureFoods Hotdog',
            'description' => 'Something that describes this shop',
            'url' => null,
            'currency' => 'USD'
        ]);

        $user->shops()->save($shop);

        $this->user = $user;

    }

    /** @test */
    public function a_user_has_an_id(){
    	$user =  User::find(1);
    	$this->assertEquals(1, $user->id);
    }

    /** @test */
    public function a_user_has_a_first_name(){
    	$this->assertEquals("John", $this->user->first_name);
    }

    /** @test */
    public function a_user_can_own_multiple_shops(){
    	$shops = User::find(1)->shops()->get();
    	var_dump($this->shops);
    	$this->assertCount(2, $shops);
    }
}
