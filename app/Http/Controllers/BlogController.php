<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Tag;
use App\Helpers\ImageHelper;
use Validator;
use Carbon\Carbon;
use File;
use Auth;
use Image;

class BlogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createBlog() {
        $tags = Tag::get();

        return view('blog.create', compact('tags'));
    }

    public function storeBlog(Request $request) {

        $validator = $request->validate([
            'title' => 'required|unique:blogs,title',
            'tag' => 'required|exists:tags,id',
            'body' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
         $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $extension;
        Storage::disk('public')->put($fileName,  File::get($image));
        
        $user_id = Auth::user()->id;

        $blog = new Blog;
        $blog->title = $request->title;
        $blog->slug = str_slug($request->title);
        $blog->body = $request->body;
        $blog->tag_id = $request->tag;
        $blog->user_id = $user_id;
        $blog->image = $fileName;
        $blog->save();

        return redirect()->route('home');
    }

    public function detailBlog($slug) {
        
        $item = Blog::where('slug', $slug)->first();
        
        $item->image = ImageHelper::getImageBlog($item);
        
        return view('blog.detail', compact('item'));
    }

    public function updateBlog($slug) {
        $tags = Tag::get();
        $blog = Blog::where('slug', $slug)->first();

        $blog->image = ImageHelper::getImageBlog($blog);

        return view('blog.update', compact('tags', 'blog'));
    }

    public function saveBlog(Request $request) {
        if ($request->file('image')) {

            $validator = $request->validate([
                'title' => 'required',
                'tag' => 'required|exists:tags,id',
                'body' => 'required',
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'id' => 'required'
            ]);
            
            $blog = Blog::find($request->id);
            
            Storage::disk('public')->delete($blog->image);

            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $extension;
            Storage::disk('public')->put($fileName,  File::get($image));
            
            $user_id = Auth::user()->id;

            $blog->title = $request->title;
            $blog->slug = str_slug($request->title);
            $blog->body = $request->body;
            $blog->tag_id = $request->tag;
            $blog->user_id = $user_id;
            $blog->image = $fileName;
            $blog->save();

            return redirect()->route('home');

        } else {
            $validator = $request->validate([
                'title' => 'required',
                'tag' => 'required|exists:tags,id',
                'body' => 'required',
                'id' => 'required'
            ]);
           
            $user_id = Auth::user()->id;
    
            $blog = Blog::find($request->id);
            $blog->title = $request->title;
            $blog->slug = str_slug($request->title);
            $blog->body = $request->body;
            $blog->tag_id = $request->tag;
            $blog->user_id = $user_id;
            $blog->save();
    
            return redirect()->route('home');
        }
    }

    public function deleteBlog(Request $request) {

        $blog = Blog::find($request->id);
        
        Storage::disk('public')->delete($blog->image);

        $blog->delete();
        return redirect()->route('home');
    }

    public function deleteComment(Request $request) {
        $comment = Comment::find($request->id);
        $comment->delete();

        return back();
    }
}
