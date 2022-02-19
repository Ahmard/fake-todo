<?php

namespace Database\Seeders;

use App\Models\Post;

class PostSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        Post::factory()
            ->count(100)
            ->create();
    }
}
