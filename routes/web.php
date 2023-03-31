<?php

use App\Http\Controllers\AdminAuth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PageViewController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
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
Route::any('/admin/login', [AdminAuth::class, 'login']);
Route::any('/forget-password', [AdminAuth::class, 'forgetPassword']);
Route::any('/reset-password/{id}', [AdminAuth::class, 'resetPassword']);


Route::group(['middleware' => 'admin'], function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::resource('/posts', PostController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/users', UserController::class);

    Route::resource('/pages', PageController::class);
    Route::get('/traffic', [PageViewController::class, 'traffic']);

    Route::get('/crud-generator', [CrudController::class, 'crudGenerator']);
    Route::any('/crud-generator/start', [CrudController::class, 'crudGeneratorStart']);

    Route::get('/crud-delete', [CrudController::class, 'crudDelete']);
    Route::get('/project-clone', [CrudController::class, 'projectClone']);
    Route::get('/download-project', [CrudController::class, 'downloadProject']);


    Route::get('/profile', [AdminController::class, 'profile']);
    Route::post('/profile-update', [AdminController::class, 'profileUpdate']);
    Route::get('/log-out', [AdminController::class, 'logOut']);
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {


});


Route::get('/', [Controller::class, 'home']);
Route::get('/mail', [Controller::class, 'mail']);
Route::get('/qr-code', [Controller::class, 'qrCode']);
Route::get('/import', [Controller::class, 'import']);

Route::get('/post-details/{id}', [Controller::class, 'postDetails']);


Route::get('/clear', function () {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});

Route::get('/controller-check', function () {

    $model_name = "PaymentLog";

    if (!File::exists(app_path('Http/Controllers/' . $model_name . 'Controller.php'))) {

        return "File Not Found";
    } else {
        return "File Found";
    }


    $model_name = "History";
    /* while (!File::exists(app_path('Http/Controllers/' . $model_name . 'Controller.php'))) {
         sleep(5);
         echo "File Not Found";
     }*/
    echo "File Found";

    return;


    $model_name = "History";
    $model_name = Str::plural($model_name);
    $route_path = preg_replace("/[A-Z]/", "-\$0", $model_name);
    return $route_path = substr(strtolower($route_path), 1);
});


