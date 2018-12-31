@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-8">
      <div class="card">
        <img src="{{ $item->image }}" class="card-img-top" alt="..." style="height: 350px;object-fit: cover;">
        <div class="card-body">
          <h4><strong>{{ $item->title }}</strong></h4>
          <span style="font-size: .8rem; color: #b5b5b5;">{{ $item->tag->name }} · {{ date('d M Y', strtotime($item->created_at)) }}</span>
          <div class="mt-2">
            <p>{{ $item->body }}</p>
          </div>
        </div>
        <div class="card-footer">
          Comments : <span class="badge badge-primary">{{ count($item->comments) }}</span>
        </div>
      </div>
    </div>
  </div>
  <div class="row justify-content-center mt-4">
    <div class="col-8">
      @if (count($item->comments) <= 0)
        <div class="card">
          <div class="card-body">
            <span>Comments are empty</span>
          </div>
        </div>
      @else
      <div class="card">
        <div class="card-body">
          @foreach ($item->comments as $comment)
            <div class="row">
              <div class="col-10">
                <div style="font-size: .85rem; color: #b5b5b5; font-weight: bolder;">{{ $comment->name }}</div>
                <div class="mb-2">{{ $comment->body }}</div>
              </div>
              <div class="col-2">
                <form action="{{ url('delete-comment/') }}" class="text-right" method="post">
                  @csrf
                  <input type="hidden" name="id" value="{{$comment->id}}">
                  <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
              </div>
            </div>
            <hr>
          @endforeach
        </div>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
