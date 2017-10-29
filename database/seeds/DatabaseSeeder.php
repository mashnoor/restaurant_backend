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
    	$this->call(CategoriesTableSeeder::class);
    	$this->call(DiscountsTableSeeder::class);
    	$this->call(MenusTableSeeder::class);
    	$this->call(TablesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
