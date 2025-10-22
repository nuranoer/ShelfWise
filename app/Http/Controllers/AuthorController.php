<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function index(Request $r)
    {
        // Top 10 author berdasarkan jumlah voter dengan rating > 5
        $authors = Author::query()
            ->withCount(['ratingsOver5 as votes'])
            ->orderByDesc('votes')
            ->take(10)
            ->get(['id', 'name']);

        // 🔹 Jika request dari Postman (expects JSON), kirim JSON
        if ($r->expectsJson() || $r->wantsJson() || $r->is('api/*')) {
            return response()->json([
                'success' => true,
                'total'   => $authors->count(),
                'data'    => $authors,
            ]);
        }

        // 🔹 Kalau dari browser, tampilkan view biasa
        return view('authors.index', compact('authors'));
    }
}
