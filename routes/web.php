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

Route::get('product/{product:slug}', [UserPanel::class, 'showProduct'])->name('showProduct');

Route::get('registration/', [UserPanel::class, 'registration'])->name('registration');

Route::post('createUser/', [UserPanel::class, 'createUser'])->name('createUser');

Route::get('login/', [UserPanel::class, 'login'])->name('login');

Route::post('loginUser/', [UserPanel::class, 'loginUser'])->name('loginUser');



Route::post('/api/takeProducts', [UserPanel::class, 'getProductsForUser']);

Route::post('/api/getMaxList', [UserPanel::class, 'getMaxList']);
