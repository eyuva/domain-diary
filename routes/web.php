<?php

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

use App\Helpers\Whois;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('User')->group(function(){
    Route::prefix('category')->group(function(){
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::get('/edit/{id}', 'CategoryController@edit')->name('category.edit');
        Route::get('/delete/{id}', 'CategoryController@delete')->name('category.delete');
        Route::post('/save', 'CategoryController@save')->name('category.save');
    });
    Route::prefix('tag')->group(function(){
        Route::get('/', 'TagController@index')->name('tag.index');
        Route::get('/edit/{id}', 'TagController@edit')->name('tag.edit');
        Route::get('/delete/{id}', 'TagController@delete')->name('tag.delete');
        Route::post('/save', 'TagController@save')->name('tag.save');
    });
    Route::prefix('domain')->group(function(){
        Route::get('/{id}', 'DomainController@index')->name('domain.index');
        Route::get('/edit/{id}', 'DomainController@edit')->name('domain.edit');
        Route::get('/delete/{id}', 'DomainController@delete')->name('domain.delete');
        Route::post('/save', 'DomainController@save')->name('domain.save');
    });
});
