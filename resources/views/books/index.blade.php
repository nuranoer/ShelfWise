@extends('layouts.app')

@section('content')
<div class="card p-3">
  <form method="get" class="row g-2 align-items-end">
    <div class="col-auto">
      <label class="form-label">List shown</label>
      <select name="limit" class="form-select">
        @for($i=10;$i<=100;$i+=10)
          <option value="{{ $i }}" {{ $i==$limit ? 'selected':'' }}>{{ $i }}</option>
        @endfor
      </select>
    </div>
    <div class="col-auto">
      <label class="form-label">Search</label>
      <input name="s" value="{{ $s }}" class="form-control" placeholder="Book or author name">
    </div>
    <div class="col-auto">
      <button class="btn btn-primary">SUBMIT</button>
    </div>
    <div class="col-auto">
      <span class="badge bg-secondary">showing {{ $rows->count() }}</span>
    </div>
  </form>

  @if(session('ok')) <div class="alert alert-success mt-3">{{ session('ok') }}</div> @endif

  <div class="table-responsive mt-3">
    <table class="table table-dark table-borderless align-middle">
      <thead class="text-secondary">
        <tr>
          <th style="width:60px">No</th>
          <th>Book Name</th>
          <th>Category Name</th>
          <th>Author Name</th>
          <th>Average Rating</th>
          <th>Voter</th>
        </tr>
      </thead>
      <tbody>
      @forelse($rows as $i => $r)
        <tr>
          <td>{{ $i+1 }}</td>
          <td>{{ $r->name }}</td>
          <td>{{ $r->category->name }}</td>
          <td>{{ $r->author->name }}</td>
          <td>{{ number_format($r->average_rating, 2) }}</td>
          <td>{{ $r->voter }}</td>
        </tr>
      @empty
        <tr><td colspan="6" class="text-center text-secondary">No data</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
  <small class="text-secondary">First load shows Top 10 books ordered by highest average rating.</small>
</div>
@endsection
