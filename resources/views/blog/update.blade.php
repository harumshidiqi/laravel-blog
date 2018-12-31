@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          Update blog
        </div>
        <div class="card-body">
          <form method="POST" action="{{ url('update-blog') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="">Blog title</label>
              <input type="text" class="form-control" name="title" required value="{{ $blog->title }}">
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Select tag</label>
              <select class="form-control" name="tag" required >
                @foreach ($tags as $item)
                  <option value={{ $item->id }} {{ $item->id == $blog->tag_id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label >Header image</label>
              <img src="{{ $blog->image }}" alt="" style="width:100%; height: 300px; object-fit:cover;" class="mb-2">
              <input type="file" class="form-control-file" name="image">
            </div>
            <div class="form-group">
              <label>Blog content</label>
              <textarea class="form-control" rows="3" style="height: 150px;" name="body">{{ $blog->body }}</textarea>
            </div>
            <input type="hidden" name="id" value="{{ $blog->id }}">
            <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
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
</div>
@endsection
