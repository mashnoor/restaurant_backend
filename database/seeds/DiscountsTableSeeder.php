<?php

use Illuminate\Database\Seeder;
use App\Discount;

class DiscountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$discounts = array(
		  array('type' => 'menu','menu_id' => '1','from_date' => '2017-06-01','to_date' => '2017-06-30','discount' => '5.00','active' => '1'),
		  array('type' => 'invoice','menu_id' => NULL,'from_date' => '2017-06-01','to_date' => '2017-06-30','discount' => '10.00','active' => '1')
		);

        foreach($discounts as $discount)
        {
        	$new_discount=new Discount;
			$new_discount->type 	=$discount['type'];
			$new_discount->menu_id 	=$discount['menu_id'];
			$new_discount->from_date=$discount['from_date'];
			$new_discount->to_date 	=$discount['to_date'];
			$new_discount->discount =$discount['discount'];
			$new_discount->active   =$discount['active'];
			$new_discount->save();
        }
    }
}
