<?php

use App\Http\Controllers\ItemsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('layouts.welcome');
});

Route::get('register', function() {
    return view('auth.register');
});

//CUSTOMED FUNCTIONS ON RESOURCES
Route::get('/searchItem', 'ItemsController@search');
Route::get('/searchStock', 'StocksController@search');
Route::get('/archiveUser', 'UserController@archive');
Route::get('/viewArchItem', 'ItemsController@archItem')->name('items.viewArch');
Route::get('/viewArchUser', 'UserController@archUser')->name('users.viewArchUser');
Route::get('/restoreItem', 'ItemsController@restore');
Route::get('/restoreUser', 'UserController@restore');
Route::delete('items/{item}/archive', 'ItemsController@archive')->name('items.archive');

Route::delete('users/{user}/archive', 'UserController@archive')->name('users.archive');

Route::get('items/{item}/restore', 'ItemsController@restore')->name('items.restore');

Route::get('users/{user}/restore', 'UserController@restore')->name('users.restore');

Route::get('items/{item}/dropdown', 'ItemsController@dropdownItems')->name('items.filter');
Route::get('items/{item}/addStock', 'StocksController@addStock')->name('stocks.addStock');
Route::get('stocks/{stock}/all', 'StocksController@dropdownIn')->name('stocks.filter_in');
Route::get('stocks/{stock}/out', 'StocksController@dropdownOut')->name('stocks.filter_out');
Route::get('kitchens/{kitchen}/dropdown', 'KitchensController@dropdownItems')->name('kitchens.filter');

//AUTHENTICATION
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//RESOURCES
Route::resource('items', 'ItemsController');
Route::resource('stocks', 'StocksController');
Route::resource('users', 'UserController');
Route::resource('positions', 'PositionsController');
Route::resource('profiles', 'ProfilesController');
Route::resource('kitchens', 'KitchensController');
Route::resource('inventories', 'InventoriesController');





