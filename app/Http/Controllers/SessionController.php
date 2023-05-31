<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SessionRequest;

class SessionController extends Controller
{
    
    public function show(Session $session) {

        $user = Auth::user();

        if($session->user->id == $user->id){
            return view('main.session.show', [
                'session' => $session
            ]);
        }else{
            return to_route('dashboard')->with('success', 'Séance introuvable');
        }

    }

    public function store(SessionRequest $request)
    {
        Session::create($request->validated());

        return to_route('dashboard')->with('success', 'La séance a bien été créé');
    }

    public function update(SessionRequest $request, Session $session)
    {
        $session->update($request->validated());

        return redirect()->route('main.session.show', ['session' => $session->id])->with('success', 'La séance a bien été modifié');
    }

}
