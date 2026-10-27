<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // د کتابونو ښکاره کول
    Route::get('/dashboard', [BookController::class, 'index'])
        ->name('dashboard');

    // د نوي کتاب ثبتول
    Route::post('/books', [BookController::class, 'store'])
        ->name('books.store');

    // د کتاب حذف کول
    Route::delete('/books/{id}', [BookController::class, 'destroy'])
        ->name('books.destroy');

    // د پروفایل لارې
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';

