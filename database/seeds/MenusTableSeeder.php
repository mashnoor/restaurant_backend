<?php

use Illuminate\Database\Seeder;
use App\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$menus = array(
		  array('category_id' => '1','code' => '101','name' => 'Pepsi','description' => '','price' =>20.00,'image' => '','available' => 1),
		  array('category_id' => '2','code' => '201','name' => 'Chicken Burger','description' => '','price' => 120.00,'image' => '','available' => 1)
		);

		foreach($menus as $menu)
		{
			$new_menu=new Menu;
			$new_menu->category_id 	=$menu['category_id'];
			$new_menu->code 		=$menu['code'];
			$new_menu->name 		=$menu['name'];
			$new_menu->description 	=$menu['description'];
			$new_menu->price 		=$menu['price'];
			$new_menu->image 		=$menu['image'];
			$new_menu->available	=$menu['available'];
			$new_menu->save();
		}
    }
}
