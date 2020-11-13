<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//http://localhost:8000/api/v1

Route::group(['prefix' => 'v1'], function () {
    Route::name('api.blog.')->group(function(){
        Route::group(['prefix' => 'blog'], function () {

           Route::get('/', [BlogController::class, 'index'])->name('index');
           Route::post('auth/login', [AuthController::class, 'login'])->name('login');
           Route::post('auth/signup', [AuthController::class, 'signup'])->name('signup');


           Route::group(['middleware' => 'auth:api'], function () {
                Route::get('users', [UserController::class, 'users'])->name('user-all');
                Route::get('users/{id}', [UserController::class, 'usersFind']);
                Route::get('home', [HomeController::class, 'index'])->name('home');
                Route::post('store', [BlogController::class, 'createBlog'])->name('store');
           });
        });
    });
});

