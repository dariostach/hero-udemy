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
    Route::get('/', 'App\Http\Controllers\AdminController@index')->name('admin.index'); // works fine

    Route::resource('heroes', 'App\Http\Controllers\HeroController');

    // el resource reemplaza a todas las rutas siguientes
    /*Route::group(['prefix' => 'heroes'], function(){
        Route::get('/', 'App\Http\Controllers\HeroController@index')->name('admin.heroes');
        Route::get('create', 'App\Http\Controllers\HeroController@create')->name('admin.heroes.create');
        Route::post('store', 'App\Http\Controllers\HeroController@store')->name('admin.heroes.store');
        Route::get('edit/{id}', 'App\Http\Controllers\HeroController@edit')->name('admin.heroes.edit');
        Route::post('update/{id}', 'App\Http\Controllers\HeroController@update')->name('admin.heroes.update');
        Route::delete('destroy/{id}', 'App\Http\Controllers\HeroController@destroy')->name('admin.heroes.destroy');
    });   */ 
    
    Route::resource('item', 'App\Http\Controllers\ItemController');
    Route::resource('enemy', 'App\Http\Controllers\EnemyController');
    //Route::get('enemies', 'App\Http\Controllers\EnemyController@index')->name('admin.enemies');
    Route::get('bs', 'App\Http\Controllers\BSController@index')->name('admin.bs');
});