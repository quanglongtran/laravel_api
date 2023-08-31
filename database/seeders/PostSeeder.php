<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestamps = [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        $dataInsert = [];
        foreach (range(1, 1000) as $int) {
            $dataInsert[] = [
                'name' => "Bài viết $int",
                'content' => "Nội dung cho bài viết $int",
                'post_thread_id' => random_int(1, 100),
                'user_id' => 1,
                ...$timestamps,
            ];
        }

        DB::table((new \App\Models\Post())->getTable())->insert($dataInsert);
    }
}
