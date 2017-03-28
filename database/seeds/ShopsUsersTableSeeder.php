<?php

use Illuminate\Database\Seeder;

class ShopsUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shop1 = App\Shop::find(1);
        $shop1->users()->save(App\User::find(3));
        $shop1->users()->save(App\User::find(4));

        $shop2 = App\Shop::find(2);
        $shop2->users()->save(App\User::find(5));
        $shop2->users()->save(App\User::find(4));
    }
}
