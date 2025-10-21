<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ShelfWise</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{ background:#0b0f19; color:#e5e7eb; }
    .card{ background:#111827; border-color:#1f2937; }
    .form-control, .form-select{ background:#0b1220; color:#e5e7eb; border-color:#1f2937; }
    a{ text-decoration:none }
    .navlink{ background:#0b1220; border:1px solid #1f2937; padding:.4rem .7rem; border-radius:.6rem; color:#e5e7eb }
  </style>
</head>
<body>
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h3 class="mb-0">ShelfWise</h3>
      <small class="text-secondary">Book popularity mini-app</small>
    </div>
    <div class="d-flex gap-2">
      <a class="navlink" href="{{ route('books.index') }}">📚 Books</a>
      <a class="navlink" href="{{ route('authors.index') }}">👤 Top Authors</a>
      <a class="navlink" href="{{ route('ratings.create') }}">⭐ Insert Rating</a>
    </div>
  </div>

  @yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
@stack('scripts')
</body>
</html>
