<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassesSeeder extends Seeder
{
    public function run(): void
    {
        $stages = DB::table('stages')->pluck('id');
        $classes = [
            ['name' => 'First grade', 'stage_id' => $stages->random()],
            ['name' => 'Second grade', 'stage_id' => $stages->random()],
            ['name' => 'Third grade', 'stage_id' => $stages->random()],
           
        ];
        DB::table('classes')->insert($classes);

    }
}
