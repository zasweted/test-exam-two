<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\RestaurantController;
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

Auth::routes();

Route::get('/restaurant', [RestaurantController::class, 'index'])->name('restaurant.index');
Route::get('/restaurant/show/{restaurant}', [RestaurantController::class, 'show'])->name('restaurant.show');
Route::get('/restaurant/edit/{restaurant}', [RestaurantController::class, 'edit'])->name('restaurant.edit');
Route::get('/restaurant/create', [RestaurantController::class, 'create'])->name('restaurant.create');
Route::post('/restaurant/store', [RestaurantController::class, 'store'])->name('restaurant.store');
Route::put('/restaurant/update/{restaurant}', [RestaurantController::class, 'update'])->name('restaurant.update');
Route::delete('/restaurant/delete/{restaurant}', [RestaurantController::class, 'destroy'])->name('restaurant.delete');

Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/show/{menu}', [MenuController::class, 'show'])->name('menu.show');
Route::get('/menu/edit/{menu}', [MenuController::class, 'edit'])->name('menu.edit');
Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store');
Route::put('/menu/update/{menu}', [MenuController::class, 'update'])->name('menu.update');
Route::delete('/menu/delete/{menu}', [MenuController::class, 'destroy'])->name('menu.delete');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
