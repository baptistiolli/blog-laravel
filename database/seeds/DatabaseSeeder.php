<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        factory('Blog\User')->create(
            [
                'name' => 'bap',
                'email' => 'baptistiolli@gmail.com',
                'password' => bcrypt(123456), // secret
                'remember_token' => str_random(10),
            ]
        );

        $this->call('PostsTableSeeder');
        $this->call('TagTableSeeder');
    }
}
