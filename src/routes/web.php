<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\SearchController;




Route::get('/', function () {
    return view('welcome');
});
//test
Route::get('/test', [TestController::class, 'index'])->name('vendor.test');
Route::get('/search-vendors', [SearchController::class,'searchVendors'])->name('search.vendors');
Route::get('/search-prefix', [SearchController::class,'searchPrefix'])->name('search.prefix');


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
