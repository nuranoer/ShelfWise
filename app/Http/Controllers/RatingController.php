<?php

// app/Http/Controllers/RatingController.php
namespace App\Http\Controllers;

use App\Models\{Author, Book, Rating};
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RatingController extends Controller
{
    public function create()
    {
        $authors = Author::orderBy('name')->get(['id','name']);
        // pilih author pertama untuk preload
        $firstAuthorId = optional($authors->first())->id;
        $books = $firstAuthorId
            ? Book::where('author_id',$firstAuthorId)->orderBy('name')->get(['id','name'])
            : collect();

        return view('ratings.create', compact('authors','books','firstAuthorId'));
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'author_id' => ['required','exists:authors,id'],
            'book_id'   => [
                'required',
                Rule::exists('books','id')->where(fn($q)=>$q->where('author_id',$r->author_id)) // book harus milik author
            ],
            'rating'    => ['required','integer','between:1,10'],
        ]);

        Rating::create(['book_id'=>$data['book_id'],'rating'=>$data['rating']]);

        return redirect()->route('books.index')->with('ok','Rating saved!');
    }

    // AJAX: buku berdasarkan author
    public function booksByAuthor($authorId)
    {
        return Book::where('author_id',$authorId)->orderBy('name')->get(['id','name']);
    }
}
