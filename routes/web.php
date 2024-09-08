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

Route::get('/admin', function () {
    return view('admin', [
        "title"=>"Login",
    ]);
});

Route::get('/admin/dashboard', [EventController::class,'dashboard'] );

Route::post('/',[EventController::class,'kirimData']);