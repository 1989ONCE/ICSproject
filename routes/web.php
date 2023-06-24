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
Route::get('warning', [WarnController::class, 'index'])->name('warning')->middleware('auth');
Route::get('/send-warning', [WarnController::class, 'sendWarningNotification']);

// realtime data
Route::get('/realtime', [RealTimeController::class, 'index'])->name('rt');
Route::post('/realtime', [RealTimeController::class, 'rtdata'])->name('rtdata');

// Route::get('realtime/csv', [RealTimeController::class, 'readCsv'])->name('csv');

// historical chart
Route::get('chart', [ChartController::class, 'index'])->name('chart')->middleware('auth');
Route::get('chart/export', [ChartController::class, 'export'])->name('export')->middleware('auth');

// profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/group', [ProfileController::class, 'group'])->name('profile.group');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// This is a route of logout for GET method(POST method is in auth.php)
Route::get('logout', [AuthController::class, 'redirect']);

require __DIR__.'/auth.php';

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('excel',function(){
    return view('excel');
});

