<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

Route::prefix('/admin')->as('admin.')->group(function () {
    //auth
    Route::middleware(['admin.is_logout'])->group(function () {
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate');
    });
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    //authenticate route group
    Route::middleware(['admin.is_login'])->group(function () {
        //dashboard
        Route::get('dashboard', [DashBoardController::class, 'index'])->name('dashboard');

        //user
        Route::prefix('user')->as('user.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index')->can('viewAny', User::class);
            Route::get('/create', [UserController::class, 'create'])->name('create')->can('create', User::class);
            Route::post('/store', [UserController::class, 'store'])->name('store')->can('create', User::class);
            Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit')->can('update', 'user');
            Route::post('/update/{user}', [UserController::class, 'update'])->name('update')->can('update', 'user');
            Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('delete')->can('delete', 'user');
        });

        //role
        Route::prefix('role')->as('role.')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('index')->can('viewAny', Role::class);
            Route::get('/create', [RoleController::class, 'create'])->name('create')->can('create', Role::class);
            Route::post('/store', [RoleController::class, 'store'])->name('store')->can('create', Role::class);
            Route::get('/edit/{role}', [RoleController::class, 'edit'])->name('edit')->can('update', 'role');
            Route::post('/update/{role}', [RoleController::class, 'update'])->name('update')->can('update', 'role');
            Route::delete('/delete/{role}', [RoleController::class, 'delete'])->name('delete')->can('delete', 'role');
        });

        //permission
        Route::prefix('permission')->as('permission.')->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('index')->can('viewAny', Permission::class);
            Route::get('/create', [PermissionController::class, 'create'])->name('create')->can('create', Permission::class);
            Route::post('/store', [PermissionController::class, 'store'])->name('store')->can('create', Permission::class);
            Route::get('/edit/{permission}', [PermissionController::class, 'edit'])->name('edit')->middleware('can:update,permission');
            Route::post('/update/{permission}', [PermissionController::class, 'update'])->name('update')->middleware('can:update,permission');
            Route::delete('/delete', [PermissionController::class, 'delete'])->name('delete');
        });
    });
});
