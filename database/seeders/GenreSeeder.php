<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
            [
                'name' => '恋愛'
            ],
            [
                'name' => 'ファンタジー'
            ],
            [
                'name' => '文学'
            ],
            [
                'name' => '歴史'
            ],
            [
                'name' => '推理'
            ],
            [
                'name' => 'ホラー'
            ],
            [
                'name' => 'コメディー'
            ],
            [
                'name' => 'SF'
            ],
            [
                'name' => 'その他'
            ],
        ]);
    }
}
