<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    // Route::post('/logout', [AuthController::class, 'logout']);
    // Route::post('/refresh', [AuthController::class, 'refresh']);
    // Route::get('/user-profile', [AuthController::class, 'userProfile']);
    // Route::post('/change-pass', [AuthController::class, 'changePassWord']);
});

Route::middleware(['verifyUser'])->group(function () {
    // PRODUCTION
    Route::get('production', [ProductionController::class, 'index']);
    Route::post('production', [ProductionController::class, 'store']);
    Route::get('production/{id}', [ProductionController::class, 'show']);
    Route::put('production/{id}', [ProductionController::class, 'update']);
    Route::delete('production/{id}', [ProductionController::class, 'destroy']);

    // USER
    Route::get('me', [UserController::class, 'getMe']);
});
