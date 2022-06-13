<?php

namespace Database\Seeders;

use App\Models\AnimalKinds;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $kinds = [
            [
                'kind' => 'cat',
                'max_size' => 30,
                'max_age' => 20,
                'growth_factor' => 1.4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kind' => 'dog',
                'max_size' => 40,
                'max_age' => 20,
                'growth_factor' => 1.8,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kind' => 'pigeon',
                'max_size' => 15,
                'max_age' => 6,
                'growth_factor' => 2.2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'kind' => 'hamster',
                'max_size' => 8,
                'max_age' => 3,
                'growth_factor' => 2.3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
         ];

         AnimalKinds::insert($kinds);
    }
}
