<?php

use Illuminate\Database\Seeder;
use App\Salespot;
class SalespotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pot = new Salespot;
        $pot->id = 1;
        $pot->shop_id = 2;
		$pot->spot_code = "ABC123";
		$pot->spot_location = null;
		$pot->name = "Dexter's Pizza";
		$pot->description = 'Pica pica';
		$pot->aisle = null;
		$pot->size = null;
		$pot->status = null;

		$pot->save();
    }
}
