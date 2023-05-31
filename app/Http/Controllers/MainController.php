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
        $sessions = Session::where('user_id', $user->id)->get();


        return view('main.dashboard', [
            'sessions' => $sessions,
            'session' => new Session(),
            'exercise' => new Exercise(),
            'exercises' => Exercise::all()
        ]);
    }

}
