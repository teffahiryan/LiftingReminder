<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRSWRequest;
use App\Http\Requests\SessionExerciseRequest;
use App\Models\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SessionRequest;
use App\Models\Exercise;



class SessionController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Session::class, 'session');
    }
 
    public function show(Session $session) {

        return view('main.session.show', [
            'session' => $session,
            'sessionExercises' => $session->exercises,
            'exercises' => Auth::user()->exercises
        ]);

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

        $session->update($request->validated());

        /** @var UploadedFile|null $image */
        $image = $request->validated('image');
        if ($image != null && !$image->getError()){
            $data['image'] = $image->store('session', 'public');
            $session->update($data);
        }

        return redirect()->route('user.session.show', ['session' => $session->id])->with('success', 'La séance a bien été modifié');

    }

    public function destroy(Session $session)
    {
        $session->delete();

        return redirect()->route('dashboard')->with('success', 'La séance a bien été supprimé');
    }

    // ADDITIONALS

    public function updateExercise(SessionExerciseRequest $request, Session $session)
    {
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
    }

    public function updateRSW(Session $session, Exercise $exercise, FormRSWRequest $request)
    {
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
    }

}

