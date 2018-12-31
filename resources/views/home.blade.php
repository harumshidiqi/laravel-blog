@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('blog.create') }}" class="btn btn-primary">Create new blog</a>
                    <hr>
                    <div class="row">
                        @forelse ($blogs as $item)
                        <div class="col-4">
                            <div class="card">
                                <img src="{{ $item->image }}" class="card-img-top" alt="..." style="height: 250px;object-fit: cover;">
                                <div class="card-body">
                                    <h4><strong>{{ $item->title }}</strong></h4>
                                    <span style="font-size: .8rem; color: #b5b5b5;">{{ $item->tag->name }} | {{ date('d M Y', strtotime($item->created_at)) }}</span>
                                    <div class="mt-2">
                                        @if (strlen($item->body) > 80)
                                            <p>{{ substr($item->body, 0, 80) }}...</p>
                                        @else
                                            <p>{{ $item->body }}</p>
                                        @endif
                                    </div>
                                    <a href="{{ url('blog/'.$item->slug.'/detail') }}" class="btn btn-primary btn-sm">Detail blog</a>
                                    <a href="{{ url('blog/'.$item->slug.'/update') }}" class="btn btn-success btn-sm">Update blog</a>
                                    <form method="POST" action="{{ url('blog/delete') }}" style="display: inline-block;">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger btn-sm inline">Delete</button>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    Comments : <span class="badge badge-primary">{{ count($item->comments) }}</span>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body text-center">
                                    <h3>Your blog is still empty</h3>
                                </div>
                            </div>
                        </div>
                        @endforelse
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
