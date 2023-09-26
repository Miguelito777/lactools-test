<?php

use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\DeleteUserController;
use App\Http\Controllers\GetUserController;
use App\Http\Controllers\UpdateUserController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1/users')->group(function () {
    Route::get('/',[ UserController::class, 'index']);
    Route::put('/{id}',[ UserController::class, 'update']);

    //CRUD clean architecture
    Route::post('/', CreateUserController::class);
    Route::get('/{id}', GetUserController::class);
    Route::put('/{id}', UpdateUserController::class);
    Route::put('/rm/{id}', DeleteUserController::class);
});