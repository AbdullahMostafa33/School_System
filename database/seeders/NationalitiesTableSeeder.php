<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nationalities')->insert([
            ['name' => 'Algerian'],
            ['name' => 'American'],
            ['name' => 'Bahraini'],
            ['name' => 'British'],
            ['name' => 'Canadian'],
            ['name' => 'Egyptian'],
            ['name' => 'Emirati'],
            ['name' => 'Iraqi'],
            ['name' => 'Jordanian'],
            ['name' => 'Kuwaiti'],
            ['name' => 'Lebanese'],
            ['name' => 'Libyan'],
            ['name' => 'Moroccan'],
            ['name' => 'Omani'],
            ['name' => 'Palestinian'],
            ['name' => 'Qatari'],
            ['name' => 'Saudi Arabian'],
            ['name' => 'Sudanese'],
            ['name' => 'Syrian'],
            ['name' => 'Tunisian'],
            ['name' => 'Yemeni'],
        ]);
    }
}
