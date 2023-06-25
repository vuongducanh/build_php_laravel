<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductionController;

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

Route::get('production', [ProductionController::class, 'index']);
Route::post('production', [ProductionController::class, 'store']);
Route::get('production/{id}', [ProductionController::class, 'show']);
Route::put('production/{id}', [ProductionController::class, 'update']);
Route::delete('production/{id}', [ProductionController::class, 'destroy']);
