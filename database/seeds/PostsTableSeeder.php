<?php

use Illuminate\Database\Seeder;
use Blog\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();

        factory('Blog\Post', 20)->create();
    }
}
