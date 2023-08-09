<?php

use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderJobExtensionsController;
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

Route::get('/', fn() => view('welcome') );
Route::resource('extensions', ExtensionController::class);
Route::resource('jobs', JobController::class);
Route::resource('orders', OrderController::class);

Route::get('orders-job-extensions/create/{job}', [OrderJobExtensionsController::class, 'ajaxCreate'])->name('orders-job-extensions.create');
Route::get('orders-job-extensions/edit/{order}', [OrderJobExtensionsController::class, 'ajaxEdit'])->name('orders-job-extensions.edit');
