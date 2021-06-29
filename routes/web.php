<?php

use App\Http\Controllers\PegawaiController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','PegawaiController@index')->name('pegawai.index');
Route::get('/pegawai/create','PegawaiController@create')->name('pegawai.create');
Route::post('/pegawai/store','PegawaiController@store')->name('pegawai.store');
Route::delete('/pegawai/{id}','PegawaiController@destroy')->name('pegawai.destroy');
Route::get('/pegawai/{id}/edit','PegawaiController@edit')->name('pegawai.edit');
Route::put('/pegawai/{id}','PegawaiController@update')->name('pegawai.update');
Route::get('/cetak','PegawaiController@cetak')->name('pegawai.cetak');


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
