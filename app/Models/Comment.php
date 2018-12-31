<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['name', 'body', 'blog_id'];

    public function blog() {
        return $this->belongsTo(Comment::class);
    }

}
