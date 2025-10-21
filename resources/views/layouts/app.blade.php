<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>@yield('title','ShelfWise')</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Bootstrap Icons (optional) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"/>

  <style>
    :root{
      --bg:#0b0f19; --text:#e5e7eb; --muted:#9ca3af; --card:#111827; --border:#1f2937; --accent:#3b82f6;
      --sidebar-w:260px;
    }
    *{box-sizing:border-box}
    html,body{height:100%}
    body{background:var(--bg);color:var(--text)}

    /* Sidebar */
    .sw-sidebar{position:fixed; inset:0 auto 0 0; width:var(--sidebar-w); background:#0d1424; border-right:1px solid var(--border); padding:16px; display:none}
    .sw-brand{display:flex;align-items:center;gap:.6rem;margin-bottom:1rem}
    .sw-brand .logo{width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,#1f3a8a,#3b82f6);display:grid;place-items:center;color:#fff;font-weight:800}
    .sw-menu a{display:flex;align-items:center;gap:.6rem;padding:.6rem .8rem;border-radius:.6rem;color:var(--text);text-decoration:none;border:1px solid transparent}
    .sw-menu a:hover{background:#0b1220;border-color:var(--border)}
    .sw-menu a.active{background:rgba(59,130,246,.14);border-color:#1e3a8a;color:#cfe1ff}
    .sw-menu .label{font-size:.92rem}
    .sw-muted{color:var(--muted);font-size:.8rem}

    /* Topbar */
    .sw-topbar{position:sticky;top:0;z-index:1020;backdrop-filter:saturate(120%) blur(6px);background:rgba(11,15,25,.72);border-bottom:1px solid var(--border)}

    /* Content area */
    .sw-content{padding:20px}
    .sw-card{background:var(--card);border:1px solid var(--border);border-radius:16px}

    /* Layout responsiveness */
    @media (min-width: 992px){ /* lg */
      .sw-sidebar{display:block}
      .sw-content{margin-left:var(--sidebar-w)}
      .sw-topbar{margin-left:var(--sidebar-w)}
    }

    /* Inputs */
    .form-control,.form-select{background:#0b1220;color:var(--text);border-color:var(--border)}
    .btn-primary{background:var(--accent);border-color:var(--accent)}
    .table{color:var(--text)}
    .table thead{color:var(--muted)}
  </style>
</head>
<body>

  <!-- Sidebar (desktop) -->
  <aside class="sw-sidebar d-lg-block">
    <div class="sw-brand">
      <div class="logo">SW</div>
      <div>
        <div class="fw-semibold">ShelfWise</div>
        <div class="sw-muted">Book Popularity Mini‑App</div>
        <div class="sw-muted">By Fitri Zuyina Nur Azizah</div>
      </div>
    </div>

    <nav class="sw-menu d-flex flex-column gap-1">
      <a href="{{ route('books.index') }}" class="@if(request()->routeIs('books.*')) active @endif">
        <i class="bi bi-book"></i><span class="label">Books</span>
      </a>
      <a href="{{ route('authors.index') }}" class="@if(request()->routeIs('authors.*')) active @endif">
        <i class="bi bi-people"></i><span class="label">Top Authors</span>
      </a>
      <a href="{{ route('ratings.create') }}" class="@if(request()->routeIs('ratings.*')) active @endif">
        <i class="bi bi-star"></i><span class="label">Insert Rating</span>
      </a>
    </nav>

    <hr class="border-secondary"/>
    <div class="sw-muted">
      <div><i class="bi bi-info-circle"></i> Rating scale 1–10</div>
      <div><i class="bi bi-check2-circle"></i> Voter = total raters</div>
      <div><i class="bi bi-graph-up"></i> Top authors: rating > 5</div>
    </div>
  </aside>

  <!-- Offcanvas Sidebar (mobile) -->
  <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasSW" aria-labelledby="offcanvasSWLabel" style="width:var(--sidebar-w);background:#0d1424;">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasSWLabel">ShelfWise</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <nav class="sw-menu d-flex flex-column gap-1">
        <a href="{{ route('books.index') }}" class="@if(request()->routeIs('books.*')) active @endif" data-bs-dismiss="offcanvas">
          <i class="bi bi-book"></i><span class="label">Books</span>
        </a>
        <a href="{{ route('authors.index') }}" class="@if(request()->routeIs('authors.*')) active @endif" data-bs-dismiss="offcanvas">
          <i class="bi bi-people"></i><span class="label">Top Authors</span>
        </a>
        <a href="{{ route('ratings.create') }}" class="@if(request()->routeIs('ratings.*')) active @endif" data-bs-dismiss="offcanvas">
          <i class="bi bi-star"></i><span class="label">Insert Rating</span>
        </a>
      </nav>
    </div>
  </div>

  <!-- Topbar -->
  <nav class="sw-topbar navbar navbar-dark">
    <div class="container-fluid">
      <div class="d-flex align-items-center gap-2">
        <button class="btn btn-outline-light d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSW" aria-controls="offcanvasSW">
          <i class="bi bi-list"></i>
        </button>
        <span class="navbar-brand mb-0 h6">@yield('page_title','ShelfWise')</span>
      </div>
      <div class="d-none d-lg-flex align-items-center gap-2">
        <a class="btn btn-sm btn-outline-light" href="{{ route('books.index') }}"><i class="bi bi-book"></i> Books</a>
        <a class="btn btn-sm btn-outline-light" href="{{ route('authors.index') }}"><i class="bi bi-people"></i> Authors</a>
        <a class="btn btn-sm btn-primary" href="{{ route('ratings.create') }}"><i class="bi bi-star"></i> Rate</a>
      </div>
    </div>
  </nav>

  <!-- Content -->
  <main class="sw-content container-fluid">
    @yield('content')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  @stack('scripts')
</body>
</html>
