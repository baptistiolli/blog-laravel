<?php

use Illuminate\Database\Seeder;
use Blog\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tag::delete();

        factory('Blog\Tag', 10)->create();
    }
}
