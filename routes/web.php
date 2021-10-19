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
Route::resource('records', RecordsController::class)->middleware('auth');
Route::resource('payment', PaymentController::class)->middleware('auth');
Route::post('paymentSearch', [PaymentController::class, 'search'])->middleware('auth');
Route::get('recordsclose/{id}', [RecordsController::class, 'close'])->middleware('auth');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
// Route::post('/search/title', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/foo', function () {
    $target = '/home/crasllpy/law/storage/app/public';
    $shortcut = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($target, $shortcut);
    print_r($_SERVER['DOCUMENT_ROOT']);
});