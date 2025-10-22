<?php

namespace App\Http\Controllers;

use App\Models\{Author, Book, Rating};
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RatingController extends Controller
{
    public function create()
    {
        $authors = Author::orderBy('name')->get(['id','name']);
        $firstAuthorId = optional($authors->first())->id;
        $books = $firstAuthorId
            ? Book::where('author_id',$firstAuthorId)->orderBy('name')->get(['id','name'])
            : collect();

        return view('ratings.create', compact('authors','books','firstAuthorId'));
    }

    public function store(Request $r)
    {
        // validasi (akan otomatis return 422 JSON jika Accept: application/json)
        $data = $r->validate([
            'author_id' => ['required','exists:authors,id'],
            'book_id'   => [
                'required',
                Rule::exists('books','id')->where(
                    fn($q) => $q->where('author_id', $r->author_id)
                ),
            ],
            'rating'    => ['required','integer','between:1,10'],
        ]);

        $rating = Rating::create([
            'book_id' => $data['book_id'],
            'rating'  => $data['rating'],
        ]);

        // ➜ Mode API / Postman → JSON
        if ($r->expectsJson() || $r->wantsJson() || $r->is('api/*')) {
            return response()->json([
                'success' => true,
                'message' => 'Rating submitted successfully',
                'data'    => $rating,
            ], 201);
        }

        // ➜ Mode Web → redirect
        return redirect()->route('books.index')->with('ok', 'Rating saved!');
    }

    // Buku berdasarkan author (JSON-friendly)
    public function booksByAuthor($authorId, Request $r)
    {
        $books = Book::where('author_id', $authorId)
            ->orderBy('name')
            ->get(['id','name']);

        // selalu aman dikembalikan sebagai JSON untuk konsumsi AJAX/Postman
        return response()->json([
            'success'   => true,
            'author_id' => (int) $authorId,
            'total'     => $books->count(),
            'data'      => $books,
        ]);
    }
}
