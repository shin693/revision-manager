<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::table('clients')->insert([
            [
                'name' => '株式会社AAA',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '株式会社BBB',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '株式会社CCC',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        DB::table('staff_members')->insert([
            [
                'name' => '山田太郎',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '佐藤花子',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '鈴木一郎',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
