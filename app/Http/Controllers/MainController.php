<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SessionRequest;
use App\Models\Exercise;

class MainController extends Controller
{
    
    public function dashboard() {

        $user = Auth::user();

        return view('main.dashboard', [
            'sessions' => $user->sessions,
            'exercises' => $user->exercises,
            'session' => new Session(),
            'exercise' => new Exercise()
        ]);
    }

}
