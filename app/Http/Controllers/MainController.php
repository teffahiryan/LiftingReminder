<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SessionRequest;
use App\Models\Exercise;
use App\Models\Tip;

class MainController extends Controller
{
    
    public function dashboard() {

        $user = Auth::user();

        return view('main.dashboard', [
            'sessions' => $user->sessions,
            'exercises' => $user->exercises,
            'session' => new Session(),
            'exercise' => new Exercise(),
            'tips' => Tip::inRandomOrder()->first()
        ]);
    }

    public function shared(){

        $sharedExercises = Exercise::where('isShared', '1')->get();

        return view('main.shared.index', [
            'exercises' => $sharedExercises,
        ]);
    }

    public function showShared(Exercise $exercise) {

        return view('main.shared.show', [
            'exercise' => $exercise
        ]);

    }

}
