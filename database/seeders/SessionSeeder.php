<?php

namespace Database\Seeders;

use App\Models\Session;
use App\Models\Exercise;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Session::factory(20)
        ->hasAttached(Exercise::factory()->count(rand(1, 4)), 
            [
                'repetition' => rand(0, 12), 
                'set' => rand(0, 4), 
                'weight' => rand(0, 100),
            ])
        ->create();
    }
}
