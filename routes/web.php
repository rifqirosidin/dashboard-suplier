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



Auth::routes();

Route::get('/', function (){
   return view('auth.login');
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function (){
    Route::resource('pembeli', 'PembeliController');
    Route::get('pembeli/delete/{id}', 'PembeliController@destroy')->name('pembeli_destroy');
    Route::resource('suplier', 'SuplierController');
    Route::resource('user', 'UserController');
    Route::get('/evaluasi', 'EvaluasiController@index')->name('evaluasi.index');
    Route::get('/evaluasi/{id}', 'EvaluasiController@create')->name('evaluasi.create');
    Route::post('/evaluasi/{id}', 'EvaluasiController@store')->name('evaluasi.store');
    Route::get('/evaluasi/{id}/edit', 'EvaluasiController@edit')->name('evaluasi.edit');
    Route::post('/evaluasi/{id}/edit', 'EvaluasiController@store')->name('evaluasi.update');
});

Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/data', 'HomeController@dashboard')->name('dataGrafik');
