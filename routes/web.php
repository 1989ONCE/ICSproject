<?php

namespace App\Http\Controllers;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RealTimeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
// EXAMPLE: Route::get('url', [Controller::class, 'function_name'])->name('view可呼叫的名字'); 

// index page
Route::get('/', function () { return view('index'); });

//  ======== function section =============
// warning management
Route::middleware('auth')->group(function () {
    Route::get('warning', [WarnController::class, 'index'])->name('warning');
    Route::post('warning', [AlarmsController::class, 'store'])->name('alarms.store');
    Route::get('send-warning', [WarnController::class, 'sendWarningNotification']);

    Route::get('alarm', [AlarmsController::class, 'show']);
    //Route::get('/alarm/store', [AlarmsController::class, 'store'])->middleware('auth');
    Route::get('/warn/check', [AlarmsController::class, 'index'])->name('warning.check');
    Route::delete('/warn/check', [AlarmsController::class, 'destroy'])->name('warn.destroy');
    Route::get('/warn/edit', [AlarmsController::class, 'edit'])->name('warning.edit');
    Route::patch('/warn/edit', [AlarmsController::class, 'update'])->name('warn.update');
});

// realtime data
Route::get('/realtime', [RealTimeController::class, 'index'])->name('rt');
Route::post('/realtime', [RealTimeController::class, 'rtdata'])->name('rtdata');

// historical chart
Route::middleware('auth')->group(function () {
    Route::get('chart', [ChartController::class, 'index'])->name('chart');
    Route::post('chart', [ChartController::class, 'linechart'])->name('linechart');
    Route::post('chart2', [ChartController::class, 'linechart2'])->name('linechart2');
    Route::get('chart/export', [ChartController::class, 'export'])->name('export');
    Route::get('chart/export2', [ChartController::class, 'export2'])->name('export2');
});

// profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/group', [ProfileController::class, 'group'])->name('profile.group');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/change-avatar', [ProfileController::class, 'change'])->name('profile.change');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

require __DIR__.'/auth.php';