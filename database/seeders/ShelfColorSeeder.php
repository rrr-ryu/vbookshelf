<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ShelfColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shelf_colors')->insert([
            [
                'name' => 'wood'
            ],
            [
                'name' => 'black'
            ],
            [
                'name' => 'white'
            ],
        ]);
    }
}
