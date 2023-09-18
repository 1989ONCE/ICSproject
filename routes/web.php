<?php

namespace App\Http\Controllers;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
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
    Route::post('warning/store', [AlarmsController::class, 'store'])->name('alarms.store');
    Route::get('send-warning', [WarnController::class, 'sendWarningNotification']);
    Route::get('device-status', [WarnController::class, 'status'])->name('status');
    Route::post('status', [WarnController::class, 'powerStatus'])->name('post_status');
    Route::get('warning/export', [WarnController::class, 'export'])->name('power');

    Route::get('warning/list', [AlarmsController::class, 'index'])->name('warning.check');
    Route::get('warning/list/search',[AlarmsController::class,'search'])->name('warn.search');
    Route::delete('warning/list', [AlarmsController::class, 'destroy'])->name('warn.destroy');
    Route::get('warning/edit', [AlarmsController::class, 'edit'])->name('warning.edit');
    Route::patch('warning/edit', [AlarmsController::class, 'update'])->name('warn.update');

    Route::get('warning/people', [WarnController::class, 'group'])->name('warning.group');
    Route::get('warning/peoplelist', [WarnController::class, 'query'])->name('warning.query');
    Route::get('warning/addpeople', [WarnController::class, 'add'])->name('add');
    Route::get('warning/storeuser', [WarnController::class, 'storeUser'])->name('storeUser');
    Route::get('warning/storegroup', [WarnController::class, 'storeGroup'])->name('storeGroup');
    Route::get('warning/delete', [WarnController::class, 'destroyUser'])->name('destroyUser');
    Route::get('warning/deleteGroup', [WarnController::class, 'destroyGroup'])->name('destroyGroup');
}
);

// realtime data
Route::get('/realtime', [RealTimeController::class, 'index'])->name('rt');
Route::get('/realtimePred', [RealTimeController::class, 'predictData'])->name('predData');
    // ajax
Route::get('/realtimeData', [RealTimeController::class, 'rtdata'])->name('rtdata');
Route::post('/realtimeOption', [RealTimeController::class, 'option'])->name('option'); 

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
    Route::delete('/profile/delete-model', [ProfileController::class, 'deleteModel'])->name('profile.deleteModel');
    Route::post('/profile/create-model', [ProfileController::class, 'createModel'])->name('profile.createModel');
    Route::post('/profile/upload-model', [ProfileController::class, 'upload'])->name('profile.upload');
    Route::post('/profile/change-avatar', [ProfileController::class, 'change'])->name('profile.change');
    Route::get('/profile/remove-avatar', [ProfileController::class, 'remove'])->name('profile.remove');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/linetest1', [LineController::class, 'show'])->name('profile.linetest');
    Route::any('/profile/linetest', [LineController::class, 'lineNotifyCallback'])->name('profile.lineconnect');
    Route::delete('/profile/line', [LineController::class, 'lineDestroy'])->name('profile.lineDestroy');

    // admin
    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.allUser');
    Route::get('/admin/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::patch('/admin/update', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/delete', [AdminController::class, 'destroy'])->name('admin.delete');


    Route::get('/admin/model', [ProfileController::class, 'model'])->name('admin.model');

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
