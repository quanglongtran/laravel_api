<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostThreadSeeder extends Seeder
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
        foreach (range(1, 100) as $int) {
            $dataInsert[] = [
                'name' => "Chủ đề $int",
                'description' => "Mô tả cho chủ đề $int",
                'post_category_id' => random_int(1, 10),
                ...$timestamps,
            ];
        }

        DB::table((new \App\Models\PostThread())->getTable())->insert($dataInsert);
    }
}
