<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name'
    ];

    public function posts()
    {
    	return $this->belongsToMany('Blog\Post', 'posts_tags');
    }
}
