<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BookColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book_colors')->insert([
            [
                'name' => 'white'
            ],
            [
                'name' => 'Red'
            ],
            [
                'name' => 'Blue'
            ],
            [
                'name' => 'yellow'
            ],
            [
                'name' => 'green'
            ],
            [
                'name' => 'pink'
            ],
            [
                'name' => 'gray'
            ],
        ]);
    }
}
