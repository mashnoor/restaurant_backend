<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public static function rules()
    {
    	$rules['table_code']='required|exists:tables,code';
    	$rules['items.*.menu_id']='required|exists:menus,id';
    	$rules['items.*.quantity']='required|numeric';

    	return $rules;
    }

    public function menus()
    {
    	return $this->belongsToMany('App\Menu')->withPivot('quantity', 'price','discount','total')->withTimestamps();
    }

    public function table()
    {
        return $this->belongsTo('App\Table');
    }
}
