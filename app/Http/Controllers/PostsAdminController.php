<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Post;

class PostsAdminController extends Controller
{
	/**
	 * @var Post
	 */
	private $post;

	public function __construct(Post $post)
	{
		$this->post = $post;
	}

    public function index()
    {
    	$posts = $this->post->paginate(10);
    	return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
    	return view('admin.posts.create');
    }
}
