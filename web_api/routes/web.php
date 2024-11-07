<?php

use App\Http\Controllers\Web\AreaController;
use App\Http\Controllers\Web\AdminController;
use App\Http\Controllers\Web\AnalysisReportController;
use App\Http\Controllers\Web\ConfirmUserSPController;
use App\Http\Controllers\Web\FloodStatusController;
use App\Http\Controllers\Web\MonitorPlaceController;
use App\Http\Controllers\Web\RiskUserController;
use App\Http\Controllers\Web\SaftyPlaceController;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['guest:admin', 'PreventBackHistory'])->group(function () {
        Route::post('check', [AdminController::class, 'check'])->name('check');
        Route::view('login', 'admin.login')->name('login');
    });

    Route::middleware(['auth:admin', 'PreventBackHistory'])->group(function () {
        Route::get('home', [FloodStatusController::class, 'home']);

        Route::get('analysis-report',AnalysisReportController::class);

        Route::resource('area', AreaController::class);
        Route::resource('monitor-place', MonitorPlaceController::class);
        Route::resource('flood-status', FloodStatusController::class);
        Route::resource('safe-place', SaftyPlaceController::class);
        Route::resource('risk-user', RiskUserController::class);
        Route::resource('confirm-user', ConfirmUserSPController::class);

        Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    });
});
Route::get('test', function () {
    // $firebaseService = app(App\Services\FirebaseService::class);
    // $firebaseService->sendNotification('eL96CU4TRR6s04r2-4KPfH:APA91bGiVJFSC47ZpZnuYZBhh9L2sbnc8fORyJphj2BFlL1IoZd-Q5GhNrF28mii2wU9kBycb5_OVL52vbd9GaUPzMUAM18fxii_jJ55l662a0X9zB0YnCM', 'Your Title', 'Your Message', []);
});
