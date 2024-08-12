<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontendController;


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


Route::get('/',[FrontendController::class,'index'])->name('frontend.index');
Route::get('/users/store', [UserController::class, 'store']);
Route::get('/users/{id}/edit', [UserController::class, 'edit']);
Route::get('/users/update/{id}', [UserController::class, 'update']);
Route::get('/users/{id}', [UserController::class, 'destroy']);
Route::get('/check-match/{userId}', [UserController::class, 'checkMatchingService']);


