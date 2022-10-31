<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\HomeController;
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


Route::get('/', [HomeController::class, 'homeList'])->name('home')->middleware('gate:home');

Auth::routes();

Route::get('/restaurant', [RestaurantController::class, 'index'])->name('restaurant.index')->middleware('gate:user');
Route::get('/restaurant/show/{restaurant}', [RestaurantController::class, 'show'])->name('restaurant.show')->middleware('gate:user');
Route::put('/restaurant/rate/{menu}', [RestaurantController::class, 'rateMenu'])->name('restaurant.rate')->middleware('gate:user');
Route::get('/restaurant/edit/{restaurant}', [RestaurantController::class, 'edit'])->name('restaurant.edit')->middleware('gate:admin');
Route::get('/restaurant/create', [RestaurantController::class, 'create'])->name('restaurant.create')->middleware('gate:admin');
Route::post('/restaurant/store', [RestaurantController::class, 'store'])->name('restaurant.store')->middleware('gate:admin');
Route::put('/restaurant/update/{restaurant}', [RestaurantController::class, 'update'])->name('restaurant.update')->middleware('gate:admin');
Route::delete('/restaurant/delete/{restaurant}', [RestaurantController::class, 'destroy'])->name('restaurant.delete')->middleware('gate:admin');

Route::get('/menu', [MenuController::class, 'index'])->name('menu.index')->middleware('gate:admin');
Route::get('/menu/show/{menu}', [MenuController::class, 'show'])->name('menu.show')->middleware('gate:admin');
Route::get('/menu/edit/{menu}', [MenuController::class, 'edit'])->name('menu.edit')->middleware('gate:admin');
Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create')->middleware('gate:admin');
Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store')->middleware('gate:admin');
Route::put('/menu/update/{menu}', [MenuController::class, 'update'])->name('menu.update')->middleware('gate:admin');
Route::delete('/menu/delete/{menu}', [MenuController::class, 'destroy'])->name('menu.delete')->middleware('gate:admin');
