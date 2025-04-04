<?php

use Illuminate\Support\Facades\Route;

Route::get('login',[\App\Http\Controllers\Auth\LoginController::class,'index'])->name('login');
Route::get('/',[\App\Http\Controllers\Auth\LoginController::class,'index']);
Route::post('login',[\App\Http\Controllers\Auth\LoginController::class,'login']);
Route::get('login/logout',[\App\Http\Controllers\Auth\LoginController::class,'logout']);

Route::get('register',[\App\Http\Controllers\Auth\RegisterController::class,'index'])->name('register');
Route::post('register',[\App\Http\Controllers\Auth\RegisterController::class,'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard',[\App\Http\Controllers\DashboardController::class,'index'])->name('dashboard');
    Route::get('transactions',[\App\Http\Controllers\TransactionController::class,'index'])->name('transactions');
    Route::get('transactions/create',[\App\Http\Controllers\TransactionController::class,'create']);
    Route::post('transactions',[\App\Http\Controllers\TransactionController::class,'store']);

    Route::get('categories',[\App\Http\Controllers\CategoryController::class,'index'])->name('categories');
    Route::get('categories/create',[\App\Http\Controllers\CategoryController::class,'create']);
    Route::post('categories',[\App\Http\Controllers\CategoryController::class,'store']);
    Route::get('categories/edit/{id}',[\App\Http\Controllers\CategoryController::class,'edit']);
    Route::put('categories/updating/{id}',[\App\Http\Controllers\CategoryController::class,'update']);
    Route::delete('categories/destroy/{id}',[\App\Http\Controllers\CategoryController::class,'destroy']);
});




