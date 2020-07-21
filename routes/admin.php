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

Route::middleware('guest:admin')->group(function (){
    Route::get('login' , 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login')->name('login');
});

Route::middleware('auth:admin')->group(function (){
    Route::get('/home'  , 'HomeController@index')->name('home');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Wiki
    Route::get('wiki'            , 'WikiController@index')->name('wiki.index');
    Route::get('wiki/create'     , 'WikiController@create')->name('wiki.create');
    Route::post('wiki'           , 'WikiController@store')->name('wiki.store');
    Route::get('wiki/{wiki_id}'  , 'WikiController@edit')->name('wiki.edit');
    Route::patch('wiki/{wiki_id}', 'WikiController@update')->name('wiki.update');
});