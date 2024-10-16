<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
         DB::table('specialties')->insert([
            ['name' => 'Arabic'],
            ['name' => 'Religious Education'],
            ['name' => 'Math'],
            ['name' => 'Science'],
            ['name' => 'History'],
            ['name' => 'Languages'],
            ['name' => 'Arts'],
            ['name' => 'Physical Education'],
            ['name' => 'Music'],
            ['name' => 'Computer Science'],
            ['name' => 'Geography'],
            ['name' => 'Economics'],
         ]);

       
    }
}
