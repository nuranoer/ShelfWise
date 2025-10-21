@extends('layouts.app')

@section('content')
<div class="card p-3">
  <h5 class="mb-3">Insert Rating</h5>
  <form method="post" action="{{ route('ratings.store') }}" class="mx-auto" style="max-width:520px">
    @csrf
    <div class="mb-3">
      <label class="form-label">Book Author</label>
      <select class="form-select" id="author_id" name="author_id" required>
        @foreach($authors as $a)
          <option value="{{ $a->id }}" {{ $a->id==$firstAuthorId?'selected':'' }}>{{ $a->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Book Name</label>
      <select class="form-select" id="book_id" name="book_id" required>
        @foreach($books as $b)
          <option value="{{ $b->id }}">{{ $b->name }}</option>
        @endforeach
      </select>
      <div class="form-text text-secondary">Book list mengikuti author yang dipilih.</div>
    </div>
    <div class="mb-3">
      <label class="form-label">Rating</label>
      <select class="form-select" name="rating" required>
        @for($i=1;$i<=10;$i++)
          <option>{{ $i }}</option>
        @endfor
      </select>
    </div>
    <button class="btn btn-primary w-100">SUBMIT</button>
  </form>
</div>
@endsection

@push('scripts')
<script>
$(function(){
  $('#author_id').on('change', function(){
    const id = $(this).val();
    $('#book_id').html('<option>Loading...</option>');
    $.getJSON("{{ route('api.books.byAuthor', ':id') }}".replace(':id', id), function(rows){
      if(rows.length === 0){
        $('#book_id').html('<option value="">-- No books for this author --</option>');
      }else{
        let opts = rows.map(r => `<option value="${r.id}">${r.name}</option>`).join('');
        $('#book_id').html(opts);
      }
    });
  });
});
</script>
@endpush
