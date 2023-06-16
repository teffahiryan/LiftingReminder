<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tips;
use App\Models\User;
use App\Models\Exercise;
use App\Models\Session;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $users = User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Ryan',
            'email' => 'ryan@gmail.com',
        ]);

        Exercise::factory(50)->create();

        Tips::factory(10)->create();

        Session::factory(20)
            ->hasAttached(Exercise::factory()->count(rand(1, 4)), ['repetition' => rand(0, 12), 'set' => rand(0, 4), 'weight' => rand(0, 100)])
            ->create();
    }
}
