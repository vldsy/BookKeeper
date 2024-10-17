<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AuthorFollowController;
use App\Http\Controllers\BookBorrowController;
use App\Http\Controllers\BookLikeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');

    Route::post('/authors/{author}/follows', [AuthorFollowController::class, 'store'])->name('authors.follows');
    Route::delete('/authors/{author}/follows', [AuthorFollowController::class, 'destroy'])->name('authors.follows');

    Route::post('/books/{book}/borrows', [BookBorrowController::class, 'store'])->name('books.borrows');
    Route::delete('/books/{book}/borrows', [BookBorrowController::class, 'destroy'])->name('books.borrows');

    Route::post('/books/{book}/likes', [BookLikeController::class, 'store'])->name('books.likes');
    Route::delete('/books/{book}/likes', [BookLikeController::class, 'destroy'])->name('books.likes');

    // route authors.follows post AuthorFollowController
    // route authors.follows delete
    // route books.borrows post BookBorrowController
    // route books.borrows delete
    // route books.likes post BookLikeController
    // route books.likes delete
});
