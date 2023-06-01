<?php

namespace App\Http\Controllers;

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

        if(ifUser($session)){
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

        if(ifUser($session)){
            $session->update($request->validated());

            /** @var UploadedFile|null $image */
            $image = $request->validated('image');
            if ($image != null && !$image->getError()){
                $data['image'] = $image->store('session', 'public');
                $session->update($data);
            }

            return redirect()->route('main.session.show', ['session' => $session->id])->with('success', 'La séance a bien été modifié');

        }else{
            return redirect()->route('dashboard');
        }
    }

    public function updateExercise(SessionExerciseRequest $request, Session $session)
    {
        if(ifUser($session)){
            $session->exercises()->sync($request->validated('exercises'));
            return redirect()->back();
        }else{
            return redirect()->route('dashboard');
        }
    }

}

function ifUser(Session $session)
{
    $user = Auth::user();

    if ($session->user->id == $user->id) {
        return true;
    }else{
        return false;
    }
}

