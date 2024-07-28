<?php

use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\DMController;
use App\Http\Controllers\Api\FloodStatusController;
use App\Http\Controllers\Api\MonitorPlaceController;
use App\Http\Controllers\Api\RiskConfirmationController;
use App\Http\Controllers\Api\RiskUserController;
use App\Http\Controllers\Api\SafetyPlaceController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PredictionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('area',[AreaController::class,'index']);
Route::post('flood-status',[FloodStatusController::class,'store']);

Route::post('prediction',PredictionController::class);

Route::prefix('user')->group(function () {
    Route::post('login',[UserController::class,'check']);
    Route::post('store',[UserController::class,'store']);

    Route::group(['middleware' => ['auth:sanctum', 'ability:user:*']], function () {
        Route::get('logout',[UserController::class,'logout']);

        Route::get('monitor-place',[MonitorPlaceController::class,'index']);
        Route::get('safety-place/{area}',[SafetyPlaceController::class,'place']);
        Route::post('risk-user',[RiskUserController::class,'store']);
        Route::post('risk-confirmation',[RiskConfirmationController::class,'store']);
    });
});

Route::prefix('dm')->group(function () {
    Route::post('login',[DMController::class,'check']);
    Route::post('store',[DMController::class,'store']);

    Route::group(['middleware' => ['auth:sanctum','ability:dm:*']], function () {
        Route::get('logout',[DMController::class,'logout']);

        Route::get('risk-user',[RiskUserController::class,'index']);
        Route::get('monitor-place',[MonitorPlaceController::class,'index']);
        Route::get('safety-place/{area}',[SafetyPlaceController::class,'place']);
    });
});
