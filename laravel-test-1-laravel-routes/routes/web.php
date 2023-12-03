<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\StatsController as AdminStatsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Task 1: point the main "/" URL to the HomeController method "index"
Route::get('/', [HomeController::class, 'index']);

// Task 2: point the GET URL "/user/[name]" to the UserController method "show"
Route::get('/user/{name}', [UserController::class, 'show']);

// Task 3: point the GET URL "/about" to the view
Route::view('/about', 'pages.about')->name('about');

// Task 4: redirect the GET URL "log-in" to a URL "login"
Route::redirect('/log-in', '/login');

// Task 5: group the following route sentences below in Route::group()
// Assign middleware "auth"
Route::middleware(['auth'])->group(function () {

    // Tasks inside that Authenticated group:
      // API CRUD routes for tasks
      Route::get('/v1/tasks', [TaskController::class, 'index']);
      Route::post('/v1/tasks', [TaskController::class, 'store']);
      Route::put('/v1/tasks/{id}', [TaskController::class, 'update']);
      Route::delete('/v1/tasks/{id}', [TaskController::class, 'destroy']);
      

    // Task 6: /app group within a group
    // Add another group for routes with prefix "app"
    Route::prefix('app')->group(function () {

        // Tasks inside that /app group:

        // Task 7: point URL /app/dashboard to a "Single Action" DashboardController
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        // Task 8: Manage tasks with URL /app/tasks/***.
        // Add ONE line to assign 7 resource routes to TaskController
        Route::resource('/tasks', TaskController::class);

    });

    // End of the /app Route Group

    // Task 9: /admin group within a group
    // Add a group for routes with URL prefix "admin"
    // Assign middleware called "is_admin" to them
    Route::prefix('admin')->middleware('is_admin')->group(function () {

        // Tasks inside that /admin group:

        // Task 10: point URL /admin/dashboard to a "Single Action" Admin/DashboardController
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboardadmin');

        // Task 11: point URL /admin/stats to a "Single Action" Admin/StatsController
        Route::get('/stats', [AdminStatsController::class, 'index'])->name('dashboardstats');

    });

    // End of the /admin Route Group

});


// One more task is in routes/api.php
require __DIR__.'/auth.php';