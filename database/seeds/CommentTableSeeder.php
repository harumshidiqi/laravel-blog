<?php

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment = new Comment();
        $comment->name = 'Bambang';
        $comment->body = 'Nice post gan!!!';
        $comment->blog_id = 1;
        $comment->save();

    }
}
