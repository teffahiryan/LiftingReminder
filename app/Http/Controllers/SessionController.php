<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRSWRequest;
use App\Http\Requests\SessionExerciseRequest;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SessionRequest;
use App\Models\Exercise;



class SessionController extends Controller
{

    public function show(Session $session) {

        $user = Auth::user();

        if($this->ifUser($session)){
            return view('main.session.show', [
                'session' => $session,
                'sessionExercises' => $session->exercises,
                'exercises' => $user->exercises
            ]);
        }else{
            return to_route('dashboard')->with('success', 'Séance introuvable');
        }

    }

    public function store(SessionRequest $request)
    {
        $session = Session::create($request->validated());

        /** @var UploadedFile|null $image */
        $image = $request->validated('image');
        if ($image != null && !$image->getError()){
            $data['image'] = $image->store('session', 'public');
            $session->update($data);
        }

        return to_route('dashboard')->with('success', 'La séance a bien été créé');
    }

    public function update(SessionRequest $request, Session $session)
    {

        if($this->ifUser($session)){
            $session->update($request->validated());

            /** @var UploadedFile|null $image */
            $image = $request->validated('image');
            if ($image != null && !$image->getError()){
                $data['image'] = $image->store('session', 'public');
                $session->update($data);
            }

            return redirect()->route('user.session.show', ['session' => $session->id])->with('success', 'La séance a bien été modifié');

        }else{
            return redirect()->route('dashboard');
        }
    }

    public function destroy(Session $session)
    {
        $session->delete();

        return redirect()->route('dashboard')->with('success', 'La séance a bien été supprimé');
    }

    // ADDITIONALS

    public function updateExercise(SessionExerciseRequest $request, Session $session)
    {

        if($this->ifUser($session)){

            $exercisesIds = $session->exercises()->pluck('id');

            for($i = 0; $i <= count($request->exercises) - 1 ; $i++){

                if($exercisesIds->contains($request->exercises[$i])){
                    $existExercise = $session->exercises()->where('exercise_id', $request->exercises[$i])->first();
                    $exercise_id_array[$request->exercises[$i]] =
                        [   
                            'repetition' => $existExercise->pivot->repetition, 
                            'set' => $existExercise->pivot->set, 
                            'weight' => $existExercise->pivot->weight
                        ];
                }else{
                    $exercise_id_array[$request->exercises[$i]] = ['repetition' => 0, 'set' => 0, 'weight' => '0'];
                }
            }

            $session->exercises()->sync($exercise_id_array);
            return redirect()->back()->with('success', 'Les exercices ont bien été mise à jour.');

        }else{
            return redirect()->route('dashboard');
        }
    }

    public function updateRSW(Session $session, Exercise $exercise, FormRSWRequest $request)
    {

        if($this->ifUser($session)){

        // Je récupère tout les exercises
        $exercises = $session->exercises()->get();

            // Je boucle sur tout les exercises
            foreach($exercises as $defaultExercise){

                // Si l'exercice déjà présent dans le tableau associatif est différent de l'exercice nécessitant un update, alors on lui laisse ces valeurs
                if($defaultExercise->id != $exercise->id){
                        
                    $exercise_id_array[$defaultExercise->id] =
                        [   
                            'repetition' => $defaultExercise->pivot->repetition, 
                            'set' => $defaultExercise->pivot->set, 
                            'weight' => $defaultExercise->pivot->weight
                        ];

                // Sinon je prépare avec les nouvelles données
                }else{
                    if($request->repetition != null){
                        $exercise_id_array[$exercise->id] = ['repetition' => $request->repetition, 'set' => $defaultExercise->pivot->set, 'weight' => $defaultExercise->pivot->weight];
                    }elseif($request->set != null){
                        $exercise_id_array[$exercise->id] = ['repetition' => $defaultExercise->pivot->repetition, 'set' => $request->set, 'weight' => $defaultExercise->pivot->weight];
                    }elseif($request->weight != null){
                        $exercise_id_array[$exercise->id] = ['repetition' => $defaultExercise->pivot->repetition, 'set' => $defaultExercise->pivot->set, 'weight' => $request->weight];
                    }
                }
            }

            // Sync totale
            $session->exercises()->sync($exercise_id_array);
            return redirect()->back();
        
        }else{
            return redirect()->route('dashboard');
        }
    }

    private function ifUser(Session $session)
    {
        return $session->user->id == auth()->id();
    }

}

