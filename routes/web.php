<?php

// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{BookController, AuthorController, RatingController};

Route::get('/', [BookController::class, 'index'])->name('books.index');

Route::get('/authors/top', [AuthorController::class, 'index'])->name('authors.index');

Route::get('/ratings/create', [RatingController::class, 'create'])->name('ratings.create');
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

// ------------------------------
// 🔹 API ROUTES (JSON endpoint untuk Postman)
// ------------------------------

Route::prefix('api')->group(function () {
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books-by-author/{author}', [RatingController::class, 'booksByAuthor']);
    Route::get('/authors/top', [AuthorController::class, 'index']);
    Route::get('/books-by-author/{author}', [RatingController::class, 'booksByAuthor'])
        ->name('api.books.byAuthor');
    Route::post('/ratings', [RatingController::class, 'store']);
});
