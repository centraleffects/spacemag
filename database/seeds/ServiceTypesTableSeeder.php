<?php

use Illuminate\Database\Seeder;

class ServiceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ServiceType::create([
        	'id' => 1,
        	'name' => 'Cleaning',
        	'description' => 'Cleaning services',
        	'price_per_day' => 250,
        	'price_per_week' => 1200
        ]);

        App\ServiceType::create([
        	'id' => 2,
        	'name' => 'Aircon Maintenance',
        	'description' => 'Cleaning and checkup of air conditioners',
        	'price_per_day' => 250,
        	'price_per_week' => 1200
        ]);
    }
}
