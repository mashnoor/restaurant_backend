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
    // return view('welcome');
	return view('login');
});

Route::get('/admin', function () {
    return view('admin.master');
});


Route::group(['prefix'=>'api/'], function() {
	Route::post('login',['as'=>'users.login','uses'=>'UsersController@login']);
	Route::group(['middleware'=>'auth:api'], function() {
		Route::get('menus/categorywise/{category_id}',['as'=>'menus.categorywise','uses'=>'MenusController@category_wise_menus']);
		Route::get('orders/summary',['as'=>'orders.summary','uses'=>'OrdersController@summary']);
		Route::resource('categories', 'CategoriesController');
		Route::resource('menus', 'MenusController');
		Route::resource('orders', 'OrdersController');
		Route::resource('discounts', 'DiscountsController');
		Route::resource('users', 'UsersController');
		Route::resource('tables', 'TablesController');
	});
});


// User login
Route::get('logins', ['as' => 'user.login', 'uses' => 'LoginAdminController@getLogin']);
Route::post('logins', ['as' => 'user.postLogin', 'uses' => 'LoginAdminController@postLogin']);
Route::get('logout', ['as' => 'user.logout', 'uses' => 'LoginAdminController@getLogout']);

Route::resource('user', 'UserController');
Route::resource('menu', 'MenuController');
Route::resource('discount', 'DiscountController');
Route::resource('category', 'CategoryController');
Route::resource('table', 'TableController');

Route::get('/order', 'OrderController@index');
Route::get('/order/show/{id}', ['as'=> 'order.show', 'uses'=> 'OrderController@show']);
Route::get('/order/process/{id}', ['as'=> 'order.process', 'uses'=> 'OrderController@orderProcess']);
Route::get('/order/serve/{id}', ['as'=> 'order.serve', 'uses'=> 'OrderController@orderServe']);
Route::get('/pantry', 'PantryController@index');
Route::get('/pantry/show/{id}', ['as'=> 'pantry.show', 'uses'=> 'OrderController@show']);

// Cash Received
Route::get('/order/manages', ['as'=> 'order.manages', 'uses'=> 'CashManagerController@orderManages']);
Route::get('/order/showCash/{id}', ['as'=> 'order.showCash', 'uses'=> 'CashManagerController@showCash']);
// Route::post('/order/billSubmit', ['as'=> 'order.billSubmit', 'uses'=> 'CashManagerController@billSubmit']);
Route::get('/order/submitBill/{id}', ['as'=> 'order.submitBill', 'uses'=> 'CashManagerController@submitBill']);
Route::get('/order/printInvoice/{id}', ['as'=> 'order.printInvoice', 'uses'=> 'CashManagerController@printInvoice']);
Route::post('/order/cashReceived/{id}', ['as'=> 'order.cashReceived', 'uses'=> 'CashManagerController@cashReceived']);

// Void Cash
Route::get('/order/voidCash/{id}', ['as'=> 'order.voidCash', 'uses'=> 'CashManagerController@voidCash']);
Route::post('/order/updateVoidCash/{id}', ['as'=> 'order.updateVoidCash', 'uses'=> 'CashManagerController@updateVoidCash']);
Route::get('/order/voidPrint/{id}', ['as'=> 'order.voidPrint', 'uses'=> 'CashManagerController@voidPrint']);

Route::get('/order/available',  'AvailableMenuController@showAvailableMenus');
Route::get('/order/availables/{id}', ['as'=> 'order.availables', 'uses'=> 'AvailableMenuController@availableMenus']);
Route::get('/order/unavailable/{id}', ['as'=> 'order.unavailable', 'uses'=> 'AvailableMenuController@unavailableMenus']);

// Daily Sales Report
Route::get('reports', ['as' => 'daily.reports', 'uses' => 'ReportsController@index']);
Route::post('reportDownload', ['as' => 'download.reports', 'uses' => 'ReportsController@reportDownload']);
Route::get('storeReports', ['as' => 'store.report', 'uses' => 'ReportsController@storeReports']);
Route::post('categoryWiseReport', ['as' => 'categorywise.reports', 'uses' => 'ReportsController@categoryWiseReport']);