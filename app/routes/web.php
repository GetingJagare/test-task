<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/logout', [LoginController::class, 'logout']);
});


Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/delete', [UserController::class, 'delete']);
    Route::post('/set-admin', [UserController::class, 'setAdmin']);
})->middleware(['auth', 'admin']);

Route::prefix('users')->group(function () {
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/edit-profile', [UserController::class, 'editProfile']);
})->middleware(['auth', 'verified']);
