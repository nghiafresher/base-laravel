<?php

use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\UserController;

Route::prefix('/admin')->as('admin.')->group(function () {
    //dashboard
    Route::get('dashboard', [DashBoardController::class, 'index'])->name('dashboard');

    //user
    Route::prefix('user')->as('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('/update', [UserController::class, 'update'])->name('update');
        Route::delete('/delete', [UserController::class, 'delete'])->name('delete');
    });
});
