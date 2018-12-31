<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Auth;
use App\Helpers\ImageHelper;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        
        $blogs = Blog::where('user_id', $user_id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        foreach ($blogs as $content) {
            $content->image = ImageHelper::getImageBlog($content);
        }

        return view('home', compact('blogs'));
    }

}
