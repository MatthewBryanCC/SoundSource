<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', [LoginController::class, 'index']);
Route::get('/signup', [LoginController::class, 'SignupIndex']);
Route::post('/signup', [LoginController::class, 'Register'])->name('signup');
Route::post('/login', [LoginController::class, 'LoginDo'])->name('login');
Route::get('/login', [LoginController::class, 'Login']);
Route::get('/logout', [LoginController::class, 'Logout']);

Route::get('/dashboard', [DashboardController::class, 'Dashboard'])->middleware('auth');
Route::post('/upload', [DashboardController::class, 'UploadFile'])->middleware('auth')->name('upload');
Route::get('/upload', [DashboardController::class, 'UploadIndex']);
Route::get('/deleteUpload/{id}', [DashboardController::class, 'DeleteRedirect']);
Route::delete('/deleteUpload/{id}', [DashboardController::class, 'Delete'])->middleware('auth');