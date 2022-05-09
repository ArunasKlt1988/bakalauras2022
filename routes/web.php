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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('user', 'UserController');
Route::get('/edit-user/{user}','UserController@edit');
Route::post('/edit-user/{user}','UserController@update');
Route::get('/add-jobcode','DarbaiController@create');
Route::post('/add-jobcode','DarbaiController@store');
Route::get('/search','UserController@search');
Route::resource('createjobcode','DarbaiController');
Route::get('/searchjobcode','DarbaiController@searchjobcode');
Route::delete('/delete-jobcode/{jobcode}','DarbaiController@delete');
Route::delete('/delete-medziaga/{Kodas}/{Id}','DarbaiController@destroymedz');
Route::delete('/delete-pavdarbas/{Kodas}/{Id}','DarbaiController@destroypavdarbas');
Route::post('/add-pavdarbas/{Kodas}','DarbaiController@addpavdarbas');
Route::post('/add-pavmedziaga/{Kodas}','DarbaiController@addpavmedziaga');
Route::resource('health','Sveikatos_TikrinimasController');
Route::resource('createhealth','Sveikatos_TikrinimasController');
Route::get('/employessforadmin','Sveikatos_TikrinimasController@index2');
Route::post('/deny/{Id}','Sveikatos_TikrinimasController@deny')->name('rejectform');
Route::post('/aprrove/{Id}','Sveikatos_TikrinimasController@approve')->name('approveform');
Route::get('/found/{Id}/{Failas}','Sveikatos_TikrinimasController@found');


