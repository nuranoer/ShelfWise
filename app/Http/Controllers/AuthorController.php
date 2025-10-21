<?php

// app/Http/Controllers/AuthorController.php
namespace App\Http\Controllers;

use App\Models\Author;

class AuthorController extends Controller
{
    public function index()
    {
        // Top 10 author berdasarkan jumlah voter dengan rating > 5
        $authors = Author::query()
            ->withCount(['ratingsOver5 as votes'])
            ->orderByDesc('votes')
            ->take(10)
            ->get(['id','name']);

        return view('authors.index', compact('authors'));
    }
}
