<?php

use Illuminate\Database\Seeder;
use App\Table;

class TablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tables=array(
        		array('code'=>'T1','capacity'=>4, 'status'=>'free'),
        		array('code'=>'T2','capacity'=>4, 'status'=>'occupied'),
                array('code'=>'T3','capacity'=>4, 'status'=>'booked')
        	);
        foreach($tables as $table)
        {
        	$new_table=new Table;
			$new_table->code 		=$table['code'];
			$new_table->capacity    =$table['capacity'];
            $new_table->status    =$table['status'];
			$new_table->save();
        }
    }
}
