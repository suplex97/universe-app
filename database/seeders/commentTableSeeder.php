<?php

namespace Database\Seeders;

use App\Models\comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class commentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $com = new comment;        
        $com->user_id = 1;
        $com->post_id = 1;
        $com->comment_text = 'This is a sample comment.'; // Adjust as needed
        $com->save();

        comment::factory()->count(10)->create();
    }
}
