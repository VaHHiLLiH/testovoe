<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserPanel;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [UserPanel::class, 'index'])->name('home');

Route::get('test/', [UserPanel::class, 'test'])->name('test');

Route::get('category/{category:slug}', [UserPanel::class, 'category'])->name('showCategory');

Route::post('/api/getProducts/', [UserPanel::class, 'getProductsForUser']);

//Route::get('categories/{category:slug}', [UserPanel::class, 'category'])->name('showCategory');

