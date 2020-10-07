<?php

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
    return view('welcome');
});
Route::get('/home/{name}', function ($name) {
    return view('home', ['name' => $name]);
    //return 'Hola '. $name .' como va?';
})->where('name', '[A-Za-z]+');

//Route::get('/admin', 'AdminController@index');
Route::group(['prefix' => 'admin'], function(){
    Route::get('/', 'App\Http\Controllers\AdminController@index')->name('admin'); // works fine
    Route::get('heroes', 'App\Http\Controllers\HeroController@index')->name('admin.heroes');
    Route::get('items', 'App\Http\Controllers\ItemController@index')->name('admin.items');
    Route::get('enemies', 'App\Http\Controllers\EnemyController@index')->name('admin.enemies');
});