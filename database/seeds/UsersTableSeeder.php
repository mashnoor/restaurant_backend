<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=array(
        		array('name'=>'Administrator','username'=>'admin','password'=>Hash::make('123456'))
        	);

        foreach($users as $user)
        {
        	$new_user=new User;
        	$new_user->name=$user['name'];
        	$new_user->username=$user['username'];
        	$new_user->password=$user['password'];
        	$new_user->save();
        }

    }
}
