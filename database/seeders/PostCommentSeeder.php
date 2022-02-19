<?php

namespace Database\Seeders;

use App\Models\PostComment;

class PostCommentSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        PostComment::query()->insert([
            [
                'postId' => 1,
                'userId' => 2,
                'comment' => 'Hello World'
            ],
            [
                'postId' => 2,
                'userId' => 1,
                'comment' => 'Hello Universe'
            ],
            [
                'postId' => 3,
                'userId' => 2,
                'comment' => 'Hello Planets'
            ],
        ]);
    }
}
