<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\PublicController;

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

Route::get('/', [PublicController::class,'index'])->name('home');

Route::get('/ads/create', [AdController::class,'create'])->name('ads.create');

Route::get('/category/{category}/ads', [PublicController::class,'adsByCategory'])->name('category.ads');
