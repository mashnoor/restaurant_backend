<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=array(
			  array('parent_id' => '0','name' => 'Beverage'),
			  array('parent_id' => '0','name' => 'Snacks')
        	);
        foreach($categories as $category)
        {
        	$new_category=new Category;
        	$new_category->parent_id=$category['parent_id'];
        	$new_category->name=$category['name'];
        	$new_category->save();
        }
    }
}
