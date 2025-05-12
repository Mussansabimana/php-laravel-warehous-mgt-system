<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\pages\DasboardController;
use App\Http\Controllers\products\ExportController;
use App\Http\Controllers\products\FurnitureController;
use App\Http\Controllers\products\ImportController;
use App\Http\Controllers\auth\AuthControllerrs;
use App\Http\Controllers\Reports\ReportController;

Route::middleware(["auth"])->group(function () {
    Route::get('/', [DasboardController::class, 'index'])->name('dashboard');
    Route::resource('furnitures', FurnitureController::class);
    Route::resource('imports', ImportController::class);
    Route::resource('exports', ExportController::class);
    Route::resource('reports', ReportController::class);
});

// authentication routes

Route::get('/login', [AuthControllerrs::class, 'showLoginForm']);
Route::get('/register', [AuthControllerrs::class, 'showRegistrationForm']);
Route::post('/login', [AuthControllerrs::class, 'login'])->name("login");
Route::post('/register', [AuthControllerrs::class, 'register'])->name("register");
Route::get('/logout', [AuthControllerrs::class, 'logout'])->name("logout");