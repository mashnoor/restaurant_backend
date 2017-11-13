<?php
namespace App;

use App\Discount;
use App\Category;
use App\Menu;
use App\User;

class Helper
{
	public static function get_menu_discount($menu_id)
	{
		$discount = Discount::where('menu_id',$menu_id)
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
		$discount = Discount::where('type','invoice')
					->where('from_date','<=',date('Y-m-d'))
					->where('to_date','>=',date('Y-m-d'))
					->where('active',1)
					->first();

		if(!is_null($discount)) return $discount->discount;
		else return 0;
	}

	public static function categoryOptions()
	{
		$categories = Category::all();
		$options[''] = '--Please Select--';
		foreach($categories as $category)
			$options[$category->id] = $category->name;

		return $options;
	}

	public static function discountMenuOptions()
	{
		$menus = Menu::all();
		$options[''] = '--Please Select--';
		foreach($menus as $menu)
			$options[$menu->id] = $menu->name;

		return $options;
	}

	public static function userOptions()
	{
		$users = User::all();
		$options[''] = '--Please Select--';
		foreach($users as $user)
			$options[$user->id] = $user->name;

		return $options;
	}


	public static function getPaymentModes()
	{
		return array(
				1 => 'Cash',
				2 => 'Visa Card',
				3 => 'Credit',
				4 => 'Advanced',
		);
	}


	public static function getUserTypes()
	{
		return array(
			'manager' => 'Manager',
			'kitchen' => 'Kitchen',
			'waiter' => 'Waiter'
		);
	}


	public static function numtowords($number) {
   
    $hyphen      = '-';
    $conjunction = '  ';
    $separator   = ' ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
      0                   => 'Zero',
      1                   => 'One',
      2                   => 'Two',
      3                   => 'Three',
      4                   => 'Four',
      5                   => 'Five',
      6                   => 'Six',
      7                   => 'Seven',
      8                   => 'Eight',
      9                   => 'Nine',
      10                  => 'Ten',
      11                  => 'Eleven',
      12                  => 'Twelve',
      13                  => 'Thirteen',
      14                  => 'Fourteen',
      15                  => 'Fifteen',
      16                  => 'Sixteen',
      17                  => 'Seventeen',
      18                  => 'Eighteen',
      19                  => 'Nineteen',
      20                  => 'Twenty',
      30                  => 'Thirty',
      40                  => 'Fourty',
      50                  => 'Fifty',
      60                  => 'Sixty',
      70                  => 'Seventy',
      80                  => 'Eighty',
      90                  => 'Ninety',
      100                 => 'Hundred',
      1000                => 'Thousand',
      1000000             => 'Million',
      1000000000          => 'Billion',
      1000000000000       => 'Trillion',
      1000000000000000    => 'Quadrillion',
      1000000000000000000 => 'Quintillion'
    );
   
    if (!is_numeric($number)) {
        return false;
    }
   
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'numtowords only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . Helper::numtowords(abs($number));
    }
   
    $string = $fraction = null;
   
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
   
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . Helper::numtowords($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = Helper::numtowords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= Helper::numtowords($remainder);
            }
            break;
    }
   
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
   
   return  $string;
	}
}