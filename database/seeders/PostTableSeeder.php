<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $post1 = new post;
        $post1->user_id = 1;
        $post1->content = 'This is a text post.';
        $post1->post_type = 'text';
        $post1->location = 'Some location';
        $post1->privacy = 'public';
        $post1->save();

        Post::factory()->count(10)->create();
    }
}
