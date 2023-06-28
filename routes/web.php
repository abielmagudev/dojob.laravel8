<?php

use App\Http\Controllers\ApiExtensionComponentController;
use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\ExtensionLoaderController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::resource('extensions', ExtensionController::class);
Route::resource('jobs', JobController::class);
Route::resource('orders', OrderController::class);

Route::post('extensions_loader', ExtensionLoaderController::class)->name('extensions.loader');

Route::get('/', function () {
    return view('welcome');
});
