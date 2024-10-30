<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomsTableSeeder extends Seeder
{
   public function run()
    {
        Classroom::factory()->count(10)->create();

    }
}
