<?php

namespace App\Http\Controllers;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
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
// Route::get('url', [Controller::class, 'function_name'])->name('view可呼叫的名字'); 

// Route::get('index', [AuthController::class, 'index'])->name('index'); 

// Route::get('login', [AuthController::class, 'loginpage'])->name('login');
// Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 

// Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
// Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 

// Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

// function section
Route::get('info', [InfoController::class, 'index'])->name('info')->middleware('auth');
Route::get('warning', [WarnController::class, 'index'])->name('warning')->middleware('auth');
Route::get('realtime', [RealTimeController::class, 'index'])->name('rt');
Route::get('chart', [ChartController::class, 'index'])->name('chart');

// routes for testing
Route::get('/', function () {
    return view('index');
    // return 'hello world';
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
