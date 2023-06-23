<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Session;
use App\Models\Exercise;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SessionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i < 20; $i++){

            $randomUser = User::all()->random()->id;

            $exercisesLengthMax = count(Exercise::where('user_id', $randomUser)->get());

            Session::factory(1, ['user_id' => $randomUser])
            ->hasAttached(
                Exercise::where('user_id', $randomUser)->inRandomOrder()->limit(rand(0, $exercisesLengthMax))->get(), 
                function(){
                    return [
                        'repetition' => rand(1, 12), 
                        'set' => rand(1, 4), 
                        'weight' => rand(0.5, 100),
                    ];
                })
            ->create();

        }
    }
}
