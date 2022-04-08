<?php

namespace Database\Seeders;

use App\Models\Formation;
use Illuminate\Database\Seeder;

class FormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Formation::create([
            'title'=>'Graphic design introduction',
            'description'=>'description',
            'price'=>4500,
            'duration'=>30,
            'status'=>'published',
            'slug'=>'slug',
        ]);
    }
}
