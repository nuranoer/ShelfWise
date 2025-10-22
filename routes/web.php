<?php

// routes/web.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{BookController, AuthorController, RatingController};

Route::get('/', [BookController::class, 'index'])->name('books.index');

Route::get('/authors/top', [AuthorController::class, 'index'])->name('authors.index');

Route::get('/ratings/create', [RatingController::class, 'create'])->name('ratings.create');
Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');

Route::get('/api/books-by-author/{author}', [RatingController::class, 'booksByAuthor'])
    ->name('api.books.byAuthor'); // JSON

// ------------------------------
// 🔹 API ROUTES (JSON endpoint untuk Postman)
// ------------------------------

// 📚 GET /api/books → list semua buku (JSON)
Route::get('/books', [BookController::class, 'index'])->name('api.books.index');

// 📚 GET /api/books-by-author/{author_id} → buku milik author tertentu
Route::get('/books-by-author/{author}', [RatingController::class, 'booksByAuthor'])->name('api.books.byAuthor');

// 👨‍💻 GET /api/authors/top → Top 10 author paling populer
Route::get('/authors/top', [AuthorController::class, 'top'])->name('api.authors.top');

// ⭐ POST /api/ratings → input rating baru
Route::post('/ratings', [RatingController::class, 'store'])->name('api.ratings.store');