<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleWare;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\Shop;

use App\Events\CustomerBecameAClient;
use App\Mail\Welcome;

class UserTest extends TestCase
{

	protected $user, $shop;
    
    function setUp()
    {
        parent::setUp();

        // User::findOrFail(1)->delete();
        // Shop::findOrFail(2)->delete();
        // Shop::findOrFail(3)->delete();

        /*User::create([
        	'id' => 1,
        	'first_name' => 'John',
			'last_name' => 'Doe',
			'email' => 'dexterb@asdsad.com',
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


        Shop::create([
            'id' => 2,
            'user_id' => 1,
            'name' => 'PureFoods Hotdog2',
            'description' => 'Something that describes this shop',
            'url' => null,
            'currency' => 'USD'
        ]);

        Shop::create([
            'id' => 3,
            'user_id' => 1,
            'name' => 'PureFoods Hotdog',
            'description' => 'Something that describes this shop',
            'url' => null,
            'currency' => 'USD'
        ]);*/
    }

    /** @test */
    public function a_customer_has_become_a_client(){
        // When a customer booked a salespot, he will be asked to accept the
        // terms and agreements, and as well as his billing information

        Event::fake();

        $this->visit('/test-event');

        $user = User::first();

        Event::assertFired(CustomerBecameAClient::class, function ($e) use ($user){
            return $e->user->id = $user->id;
        });
    }

    /** @test */
    public function it_fakes_mail(){
        Mail::fake();
        $user = User::first();
        $this->visit('/test-mail');

        Mail::assertSentTo($user->email, Welcome::class);
    }
}
