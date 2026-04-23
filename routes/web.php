<?php

use App\Http\Controllers\TargetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/targets', [TargetController::class, 'index'])->name('targets.index');

Route::get('targets/create', [TargetController::class, 'create'])->name('targets.create');

Route::post('/targets', [TargetController::class, 'store'])->name('targets.store');

Route::get('/targets/{target}', [TargetController::class, 'show'])->name('targets.show');

use App\Http\Controllers\ActivityController;

// Activity සේව් කරන්න අවශ්‍ය Route එක
Route::post('/targets/{target}/activities', [ActivityController::class, 'store'])->name('activities.store');
