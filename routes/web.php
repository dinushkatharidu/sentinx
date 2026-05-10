<?php

use App\Http\Controllers\TargetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/targets', [TargetController::class, 'index'])->name('targets.index');

Route::get('targets/create', [TargetController::class, 'create'])->name('targets.create');

Route::post('/targets', [TargetController::class, 'store'])->name('targets.store');

Route::get('/targets/{target}', [TargetController::class, 'show'])->name('targets.show');

use App\Http\Controllers\ActivityController;

// For save activities
Route::post('/targets/{target}/activities', [ActivityController::class, 'store'])->name('activities.store');

// show edit form
Route::get('/targets/{target}/edit', [TargetController::class, 'edit'])->name('targets.edit');

Route::put('/targets/{target}', [TargetController::class, 'update'])->name('targets.update');

// delete
Route::delete('/targets/{target}', [TargetController::class, 'destroy'])->name('targets.destroy');

Route::delete('/evidence/{evidence}', [TargetController::class, 'destroyEvidence'])->name('evidence.destroy');

//For generate Report pdf
Route::get('/targets/{target}/report', [TargetController::class, 'generateReport'])->name('targets.report');

//dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//Master Report
Route::get('/reports/global-master', [App\Http\Controllers\TargetController::class, 'generateGlobalReport'])->name('reports.global-master');

// Global Master Report
Route::get('/reports/global-master', [App\Http\Controllers\TargetController::class, 'generateGlobalMasterReport'])->name('reports.global-master');
