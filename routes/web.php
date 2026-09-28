<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkRequestController;
use App\Http\Controllers\MessageController;

Route::get('/work_requests', [WorkRequestController::class, 'index'])
    ->name('work_requests.index');
Route::get('/work_requests/create', [WorkRequestController::class, 'create'])
    ->name('work_requests.create');
Route::post('/work_requests', [WorkRequestController::class, 'store'])
    ->name('work_requests.store');
Route::get('/work_requests/{id}', [WorkRequestController::class, 'show'])
    ->name('work_requests.show');
Route::get('/work_requests/{id}/edit', [WorkRequestController::class, 'edit'])
    ->name('work_requests.edit');
Route::put('/work_requests/{id}', [WorkRequestController::class, 'update'])
    ->name('work_requests.update');
Route::delete('/work_requests/{id}', [WorkRequestController::class, 'destroy'])
    ->name('work_requests.destroy');
Route::post('/work_requests/{id}/messages', [MessageController::class, 'store'])
    ->name('work_requests.messages.store');
