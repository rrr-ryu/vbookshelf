<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            [
                'user_id' => 1,
                'title' => 'wood',
                'title' => 'test_title',
                'url' => 'https://www.test',
                'type_id' => 1,
                'site_name_id' => 1,
                'genre_id' => 2,
                'finish' => true ,
                'read_page' => 1,
                'all_page' => 99,
                'assessment' => 5,
                'book_color_id' => 1,
                'created_at' => '2022/01/01 11:11:11',
            ],
        ]);
    }
}
