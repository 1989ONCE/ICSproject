<?php
namespace App\Http\Controllers;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomAuthController;
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

Route::get('index', [CustomAuthController::class, 'dashboard']); 

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 

Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 

Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

// function section
Route::get('info', [InfoController::class, 'index'])->name('info'); 
Route::get('warn', [WarnController::class, 'index'])->name('warning'); 
Route::get('realtime', [RealTimeController::class, 'index'])->name('rt'); 
Route::get('chart', [ChartController::class, 'index'])->name('chart'); 



// routes for testing
Route::get('/', function () {
    return view('welcome');
    // return 'hello world';
});

Route::get('/login2', [UserController::class, 'index']);

Route::get('/users', function()
{
    return 'Users!';
});