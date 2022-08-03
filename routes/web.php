<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;

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
Route::get('/ads/{ad}', [PublicController::class,'show'])->name("ads.show");

Route::get('/category/{category:name}/ads', [PublicController::class,'adsByCategory'])->name('category.ads');

Route::get('/revisor',[RevisorController::class,'index'] )->name('revisor.home');

Route::post('/revisor/ad/{id}/accept',[RevisorController::class,'accept'])->name('revisor.ad.accept');
Route::post('/revisor/ad/{id}/reject',[RevisorController::class,'reject'])->name('revisor.ad.reject');