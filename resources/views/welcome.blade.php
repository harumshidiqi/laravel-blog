@extends('layouts.app')

@section('content')
<div class="jumbotron">
  <div class="container">
    <div class="row justify-content-start">
      <div class="col-8">
        <h1 class="display-4">Blog For Everyone</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sed nisl nec sapien egestas aliquet. Fusce feugiat tristique nisl tristique mattis.</p>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row py-4">
      @foreach ($all_blogs as $item)
      <div class="col-4 mb-4">
          <div class="card">
              <img src="{{ $item->image }}" class="card-img-top" alt="..." style="height: 250px;object-fit: cover;">
              <div class="card-body">
                  <h4><strong>{{ $item->title }}</strong></h4>
                  <span style="font-size: .8rem; color: #b5b5b5;">{{ $item->tag->name }} · {{ date('d M Y', strtotime($item->created_at)) }} · {{ $item->user->name }}</span>
                  <div class="mt-2">
                      @if (strlen($item->body) > 80)
                          <p>{{ substr($item->body, 0, 80) }}...</p>
                      @else
                          <p>{{ $item->body }}</p>
                      @endif
                  </div>
                  <a href="{{ url('blog/'.$item->slug) }}" class="btn btn-primary">Detail blog</a>
              </div>
              <div class="card-footer">
                Comments : <span class="badge badge-primary">{{ count($item->comments) }}</span>
              </div>
          </div>
      </div>
      @endforeach
  </div>
  <div class="row mb-4 justify-content-center">
    <div class="d-flex justify-content-center">
      {{ $all_blogs->links() }}
    </div>
  </div>
</div>
@endsection
