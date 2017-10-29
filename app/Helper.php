<?php
namespace App;

use App\Discount;
use App\Category;

class Helper
{
	public static function get_menu_discount($menu_id)
	{
		$discount=Discount::where('menu_id',$menu_id)
					->where('type','menu')
					->where('from_date','<=',date('Y-m-d'))
					->where('to_date','>=',date('Y-m-d'))
					->where('active',1)
					->first();

		if(!is_null($discount)) return $discount->discount;
		else return 0;
	}

	public static function get_invoice_discount()
	{
		$discount=Discount::where('type','invoice')
					->where('from_date','<=',date('Y-m-d'))
					->where('to_date','>=',date('Y-m-d'))
					->where('active',1)
					->first();

		if(!is_null($discount)) return $discount->discount;
		else return 0;
	}

	public static function categoryOptions()
	{
		$categories=Category::all();
		$options['']='--Please Select--';
		foreach($categories as $category)
			$options[$category->id]=$category->name;

		return $options;
	}

	public static function discountOptions()
	{
		$discounts=Discount::all();
		$options['']='--Please Select--';
		foreach($discounts as $discount)
			$options[$discount->id]=$discount->id;

		return $options;
	}
}