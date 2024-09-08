<?php

use App\Http\Controllers\EventController;
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


Route::get('/', [EventController::class,'index']);

Route::middleware('auth')->group(function () {
    Route::get('/home', [EventController::class,'dashboard'] );
});

    
Route::post('/',[EventController::class,'kirimData']);
Auth::routes();
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::delete('/events/{id}', [EventController::class, 'delete'])->name('events.destroy');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
