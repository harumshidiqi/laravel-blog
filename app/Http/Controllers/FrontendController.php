<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;
use App\Models\Comment;
use App\Helpers\ImageHelper;

class FrontendController extends Controller
{
    public function index() {
        $all_blogs = Blog::orderBy('created_at', 'desc')->paginate(6);

        foreach ($all_blogs as $content) {
            $content->image = ImageHelper::getImageBlog($content);
        }

        return view('welcome', compact('all_blogs'));
    }

    public function detail($slug) {
        $blog = Blog::where('slug',$slug)->first();
        $blog_list = Blog::where('slug', '!=', $slug)->orderBy('created_at', 'desc')->take(4)->get();

        $blog->image = ImageHelper::getImageBlog($blog);
        
        foreach ($blog_list as $content) {
            $content->image = ImageHelper::getImageBlog($content);
        }

        return view('detail', compact('blog', 'blog_list'));
    }

    public function comment(Request $request, $id) {
        $comment = new Comment;

        $comment->name = $request->name;
        $comment->body = $request->body;
        $comment->blog_id = $id;
        $comment->save();

        return back();
    }
}
