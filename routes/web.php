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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::post('/store', 'Payment@store')->name('payment-store');
Route::post('/ach', 'Payment@store_ach')->name('payment-ach');
Route::get('/{id}', 'Payment@index')->name('payment');
Route::get('/success-card-transaction/{amount}/{tran_id}/{email}', 'Payment@success_card')->name('success-card');
Route::get('/success-ach-transaction/{amount}/{tran_id}/{email}', 'Payment@success_ach')->name('success-ach');