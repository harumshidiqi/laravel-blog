@extends('layouts.app')

@section('content')
<div class="jumbotron" style="background-image: url({{ $blog->image }}); background-size: cover; height: 450px;"></div>
<div class="container">
  <div class="row py-4">
    <div class="col-8">
      <div class="card mb-4">
        <div class="card-body">
          <h1 style="font-size: 2.4rem;"><strong>{{ $blog->title }}</strong></h1>
          <p>{{ $blog->tag->name }} · {{ date('d M Y', strtotime($blog->created_at)) }} · {{ $blog->user->name }}</p>
          <div class="mt-4">
            <p>{{ $blog->body }}</p>
          </div>
        </div>
        <div class="card-footer">
          Comments : <span class="badge badge-primary">{{ count($blog->comments) }}</span>
        </div>
      </div>
      <div class="accordion" id="accordionExample">
        <div class="card mb-4">
          <div class="card-header">
            <h2 class="mb-0">
              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Add new comment
              </button>
            </h2>
          </div>
          <div id="collapseOne" class="collapse" data-parent="#accordionExample">
            <div class="card-body">
              <form action="{{ url('add_comment/'.$blog->id) }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                  <label>Comment</label>
                  <textarea class="form-control" rows="3" style="height: 150px;" name="body" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
              @if ($errors->any())
                  <div class="alert alert-danger mt-4">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif 
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          @foreach ($blog->comments as $comment)
              <span>{{ $comment->name }} · {{ date('d M Y', strtotime($comment->created_at)) }}</span>
              <p>{{ $comment->body }}</p>
              <hr>
          @endforeach
          <div>

          </div>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card">
        <div class="card-header">
          Another Blogs
        </div>
        <div class="card-body">
          @foreach ($blog_list as $item)
          <div class="">
            <a href="{{ url('blog/'.$item->slug) }}" style="font-weight: bold; display:block;">{{ $item->title }}</a>
            <span style="color: #aaaaaa; font-size: .8rem;">{{ $item->tag->name }} · {{ date('d M Y', strtotime($item->created_at)) }} · {{ $item->user->name }}</span>
            <hr>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
