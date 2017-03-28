<?php

use Illuminate\Database\Seeder;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Shop::create([
        	'id' => 1,
        	'user_id' => 1,
        	'name' => 'Rebuy Shop',
        	'description' => 'Lorem ipsum dolor sit',
        	'url' => null,
        	'currency' => null
        ]);

        App\Shop::create([
        	'id' => 2,
        	'user_id' => 2,
        	'name' => 'Rebuy Shop 2',
        	'description' => 'Lorem ipsum dolor sit 2',
        	'url' => null,
        	'currency' => null
        ]);
    }
}
