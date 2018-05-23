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
    Route::prefix('domain')->group(function(){
        Route::get('/{id}', 'DomainController@index')->name('domain.index');
        Route::get('/edit/{id}', 'DomainController@edit')->name('domain.edit');
        Route::get('/delete/{id}', 'DomainController@delete')->name('domain.delete');
        Route::post('/save', 'DomainController@save')->name('domain.save');
    });
});
