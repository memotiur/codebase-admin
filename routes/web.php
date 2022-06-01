<?php

use App\Http\Controllers\AdminAuth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
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

Route::any('/login', [AdminAuth::class, 'login']);


Route::group(['middleware' => 'admin'], function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/log-out', [AdminController::class, 'logOut']);
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {


});


Route::get('/', [Controller::class, 'home']);
