<?php

namespace Database\Seeders;

use App\Models\Stage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Stages = ['Secondary stage','Preparatory stage','Primary stage'];
        foreach($Stages as $Item)
        {
            Stage::create(['name' => $Item]);
        }
    }
}
