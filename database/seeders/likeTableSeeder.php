<?php

namespace Database\Seeders;

use App\Models\like;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class likeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $like1 = new like;
        $like1->user_id = 1;
        $like1->post_id = 1;
        $like1->reaction = 'like';
        $like1->save();

        like::factory()->count(10)->create();
    }
}
