<?php

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
    return view('welcome');
});

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/menu', [App\Http\Controllers\HomeController::class, 'menu'])->name('menu');
    Route::get('/prodotti', [App\Http\Controllers\HomeController::class, 'products'])->name('products');
    Route::get('/pasti', [App\Http\Controllers\HomeController::class, 'meals'])->name('meals');
    Route::get('/reparti', [App\Http\Controllers\HomeController::class, 'departments'])->name('departments');
    Route::get('/sconti', [App\Http\Controllers\HomeController::class, 'discounts'])->name('discounts');
    Route::get('/nuovaRicevuta', [App\Http\Controllers\HomeController::class, 'new_receipts'])->name('new_receipts');
    Route::get('/ricevute', [App\Http\Controllers\HomeController::class, 'receipts'])->name('receipts');
    Route::get('/test', function(){
        $p = \App\Models\Product::first();
        var_dump($p->department->toArray());
    })->name('test');
});

Auth::routes();

