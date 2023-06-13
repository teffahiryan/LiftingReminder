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
        $exercise = Exercise::create($request->validated());

        /** @var UploadedFile|null $image */
        $image = $request->validated('image');
        if ($image != null && !$image->getError()){
            $data['image'] = $image->store('exercise', 'public');
            $exercise->update($data);
        }

        return to_route('dashboard')->with('success', 'L\'exercice a bien été créé');
    }

    public function update(ExerciseRequest $request, Exercise $exercise)
    {
        $exercise->update($request->validated());

            /** @var UploadedFile|null $image */
            $image = $request->validated('image');
            if ($image != null && !$image->getError()){
                $data['image'] = $image->store('exercise', 'public');
                $exercise->update($data);
            }

        return redirect()->route('user.exercise.show', ['exercise' => $exercise->id])->with('success', 'L\'exercice a bien été modifié');
    }

    public function shared(Exercise $exercise)
    {

        Exercise::create([
            'name' => $exercise->name,
            'description' => $exercise->description,
            'isShared' => 0,
            'user_id' => Auth::user()->id,
            'sharedCreator' => $exercise->user->name
        ]);

        return redirect()->route('dashboard')->with('success', 'L\'exercice a bien été ajouté a votre tableau de bord');
    }

    public function destroy(Exercise $exercise)
    {
        $exercise->delete();

        return redirect()->route('dashboard')->with('success', 'L\'exercice a bien été supprimé');
    }

}


