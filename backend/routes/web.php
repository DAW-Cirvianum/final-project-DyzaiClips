<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserAdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/users', [UserAdminController::class, 'index'])->name('admin.users');

    Route::post('/users/{user}/role', [UserAdminController::class, 'changeRole'])
        ->name('admin.users.role');

    Route::delete('/users/{user}', [UserAdminController::class, 'destroy'])
        ->name('admin.users.delete');
});