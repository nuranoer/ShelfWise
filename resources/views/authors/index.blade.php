@extends('layouts.app')

@section('content')
<div class="card p-3">
  <h5 class="mb-3">Top 10 Most Famous Author</h5>
  <div class="table-responsive">
    <table class="table table-dark table-borderless">
      <thead class="text-secondary">
        <tr>
          <th style="width:60px">No</th>
          <th>Author Name</th>
          <th>Voter</th>
        </tr>
      </thead>
      <tbody>
        @forelse($authors as $i=>$a)
          <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $a->name }}</td>
            <td>{{ $a->votes }}</td>
          </tr>
        @empty
          <tr><td colspan="3" class="text-center text-secondary">No data</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <small class="text-secondary">Note: only voters with rating &gt; 5 are counted.</small>
</div>
@endsection
