<?php

use App\Http\Controllers\ExtensionController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobExtensionsController;
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

Route::get('/', fn() => view('welcome') );
Route::resource('extensions', ExtensionController::class);
Route::resource('jobs', JobController::class);
Route::resource('orders', OrderController::class);
Route::post('job-extensions', JobExtensionsController::class)->name('job_extensions');
