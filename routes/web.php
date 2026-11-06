<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('projects', ProjectController::class);
    Route::post('/projects/{id}/participants', [ProjectController::class, 'addParticipant'])->name('projects.participants.store');
    Route::put('/projects/{id}/participants/{userId}', [ProjectController::class, 'updateParticipant'])->name('projects.participants.update');
    Route::delete('/projects/{id}/participants/{userId}', [ProjectController::class, 'removeParticipant'])->name('projects.participants.destroy');
});

require __DIR__.'/auth.php';