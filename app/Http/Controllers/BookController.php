<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $r)
    {
        // Limit 10..100 (kelipatan 10)
        $limit = (int) $r->get('limit', 10);
        if ($limit < 10 || $limit > 100 || $limit % 10 !== 0) {
            $limit = 10;
        }

        $s = trim((string) $r->get('s', ''));

        $q = Book::query()
            ->with(['author:id,name', 'category:id,name'])
            ->withCount('ratings as voter')
            ->withAvg('ratings as average_rating', 'rating');

        if ($s !== '') {
            $q->where(function ($w) use ($s) {
                $w->where('name', 'like', "%$s%")
                  ->orWhereHas('author', fn($a) => $a->where('name', 'like', "%$s%"));
            });
        }

        // hanya buku yang punya voter
        $q->having('voter', '>', 0)
          ->orderByDesc('average_rating')
          ->orderByDesc('voter');

        $rows = $q->take($limit)->get();

        // 🔹 Jika request dari Postman (expects JSON), kirim JSON response
        if ($r->expectsJson() || $r->wantsJson() || $r->is('api/*')) {
            return response()->json([
                'success' => true,
                'total'   => $rows->count(),
                'data'    => $rows,
            ]);
        }

        // 🔹 Kalau dari browser, tampilkan view biasa
        return view('books.index', compact('rows', 'limit', 's'));
    }
}
