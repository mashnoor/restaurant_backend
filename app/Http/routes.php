<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin.master');
});


Route::group(['prefix'=>'api/'], function() {
	Route::post('login',['as'=>'users.login','uses'=>'UsersController@login']);
	Route::group(['middleware'=>'auth:api'], function() {
		Route::get('menus/categorywise/{category_id}',['as'=>'menus.categorywise','uses'=>'MenusController@category_wise_menus']);
		Route::resource('categories', 'CategoriesController');
		Route::resource('menus', 'MenusController');
		Route::resource('orders', 'OrdersController');
		Route::resource('discounts', 'DiscountsController');
		Route::resource('users', 'UsersController');
		Route::resource('tables', 'TablesController');
	});
});


Route::resource('menu', 'MenuController');
Route::resource('discount', 'DiscountController');
Route::resource('category', 'CategoryController');
Route::resource('table', 'TableController');

Route::get('/order', 'OrderController@index');
Route::get('/order/show/{id}', ['as'=> 'order.show', 'uses'=> 'OrderController@show']);
Route::get('/order/process/{id}', ['as'=> 'order.process', 'uses'=> 'OrderController@orderProcess']);
Route::get('/order/serve/{id}', ['as'=> 'order.serve', 'uses'=> 'OrderController@orderServe']);
Route::get('/pantry', 'PantryController@index');

Route::get('/order/manages', ['as'=> 'order.manages', 'uses'=> 'CashManagerController@orderManages']);
Route::get('/order/showCash/{id}', ['as'=> 'order.showCash', 'uses'=> 'CashManagerController@showCash']);
Route::get('/order/billSubmit/{id}', ['as'=> 'order.billSubmit', 'uses'=> 'CashManagerController@billSubmit']);
Route::get('/order/cashReceived/{id}', ['as'=> 'order.cashReceived', 'uses'=> 'CashManagerController@cashReceived']);
Route::post('/order/getPaymentModes/{id}', ['as'=> 'order.getPaymentModes', 'uses'=> 'CashManagerController@getPaymentModes']);
Route::get('/order/available',  'AvailableMenuController@showAvailableMenus');
Route::get('/order/availables/{id}', ['as'=> 'order.availables', 'uses'=> 'AvailableMenuController@availableMenus']);
Route::get('/order/unavailable/{id}', ['as'=> 'order.unavailable', 'uses'=> 'AvailableMenuController@unavailableMenus']);
