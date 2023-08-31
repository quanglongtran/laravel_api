<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostCategorySeeder extends Seeder
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
        foreach (range(1, 10) as $int) {
            $dataInsert[] = [
                'name' => "Danh mục $int",
                'description' => "Mô tả cho danh mục $int",
                ...$timestamps
            ];
        }

        DB::table((new \App\Models\PostCategory)->getTable())->insert($dataInsert);
    }
}
