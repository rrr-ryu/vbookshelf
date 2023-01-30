<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SiteNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_names')->insert([
            [
                'name' => '小説家になろう'
            ],
            [
                'name' => 'カクヨム'
            ],
            [
                'name' => 'アルファポリス'
            ],
            [
                'name' => '魔法のiランド'
            ],
            [
                'name' => 'エブリスタ'
            ],
            [
                'name' => 'その他'
            ],
        ]);
    }
}
