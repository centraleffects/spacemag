<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(ShopsTableSeeder::class);
        // $this->call(ShopsUsersTableSeeder::class);
        // $this->call(ArticlesTableSeeder::class);
        // $this->call(TodoTasksTableSeeder::class);
        // $this->call(SalespotsTableSeeder::class);
        $this->call(ServiceTypesTableSeeder::class);
    }
}
