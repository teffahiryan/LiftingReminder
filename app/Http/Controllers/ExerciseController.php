<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExerciseRequest;
use App\Models\Session;
use Illuminate\Support\Facades\Validator;

class ExerciseController extends Controller
{
        
    public function show(Exercise $exercise) {

        $user = Auth::user();

        if($exercise->user->id == $user->id){
            return view('main.exercise.show', [
                'exercise' => $exercise
            ]);
        }else{
            return to_route('dashboard')->with('success', ' L\'exercice est introuvable');
        }

    }

    public function store(ExerciseRequest $request)
    {
        Exercise::create($request->validated());

        return to_route('dashboard')->with('success', 'L\'exercice a bien été créé');
    }

    public function update(ExerciseRequest $request, Exercise $exercise)
    {
        $exercise->update($request->validated());

        return redirect()->route('main.exercise.show', ['exercise' => $exercise->id])->with('success', 'L\'exercice a bien été modifié');
    }

    public function updateRSW(Exercise $exercise, Request $request)
    {

        if(ifUser($exercise)){
            if($request->repetition != null){
                $exercise->update(['repetition' => $request->repetition]);
            }elseif($request->set != null){
                $exercise->update(['set' => $request->set]);
            }
            return redirect()->back();
        }else{
            return redirect()->route('dashboard');
        }
    }
}

function ifUser(Exercise $exercise)
{
    $user = Auth::user();

    if ($exercise->user->id == $user->id) {
        return true;
    }else{
        return false;
    }
}
