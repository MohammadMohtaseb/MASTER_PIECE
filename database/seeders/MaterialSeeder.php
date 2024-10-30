<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Materials = ['Arabic','English','mathematics'];
        foreach($Materials as $Item)
        {
            Material::create(['name'=>$Item]);
        }
    }
}
