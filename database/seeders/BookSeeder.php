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
                'title' => '訳あり伯爵様と契約結婚したら、義娘（６歳）の契約母になってしまいました。　〜契約期間はたったの一年間〜',
                'url' => 'https://ncode.syosetu.com/n7866hz/',
                'type_id' => 2,
                'site_name_id' => 2,
                'genre_id' => 2,
                'finish' => true ,
                'read_page' => 0,
                'all_page' => 24,
                'assessment' => 5,
                'book_color_id' => 1,
                'created_at' => '2022/01/01 11:11:11',
            ],
        ]);
    }
}
