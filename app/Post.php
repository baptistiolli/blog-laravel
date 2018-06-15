<?php

namespace Blog;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = array(
    	'title',
    	'content'
    );

    public function comments()
    {
        return $this->hasMany('Blog\Comment');
    }

    public function tags()
    {
    	return $this->belongsToMany('Blog\Tag', 'posts_tags');
    }
}
