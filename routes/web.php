<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Auth;
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
    // return view('welcome');
    return response()->redirectTo('/home');
});

Auth::routes();
Route::resource('records', RecordsController::class);
Route::resource('payment', PaymentController::class);
Route::post('paymentSearch', [PaymentController::class, 'search']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::post('/search/title', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
