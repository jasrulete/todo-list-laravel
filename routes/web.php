<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [TodoController::class, 'index']);
    Route::post('/todos', [TodoController::class, 'store']);
    Route::get('/todos/{todo}/edit', [TodoController::class, 'edit']);
    Route::post('/todos/{todo}', [TodoController::class, 'update']);
    Route::post('/todos/{todo}/toggle', [TodoController::class, 'toggle']);
    Route::post('/todos/{todo}/delete', [TodoController::class, 'destroy']);
});

require __DIR__.'/auth.php';