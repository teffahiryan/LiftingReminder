<?php

namespace App\Http\Controllers\Admin;

use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SessionRequest;

class SessionController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $sessions = Session::all();

        return view('admin.session.index', [
            'sessions' => $sessions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $session = new Session();

        if($user = Auth::id()){
            $session->user_id = $user;
        }

        return view('admin.session.form', [
            'session' => $session
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SessionRequest $request)
    {
        $session = Session::create($request->validated()); 

        /** @var UploadedFile|null $image */
        $image = $request->validated('image');
        if ($image != null && !$image->getError()){
            $data['image'] = $image->store('session', 'public');
            $session->update($data);
        }

        return to_route('admin.session.index')->with('success', 'La séance a bien été créé');
    }

    /**
     * Display the specified resource.
     */
    public function show(Session $session)
    {
        return view('admin.session.show', [
            'session' => $session
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Session $session)
    {
        return view('admin.session.form', [
            'session' => $session
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SessionRequest $request, Session $session)
    {
        $session->update($request->validated());

        /** @var UploadedFile|null $image */
        $image = $request->validated('image');
        if ($image != null && !$image->getError()){
            $data['image'] = $image->store('session', 'public');
            $session->update($data);
        }

        return redirect()->route('admin.session.show', ['session' => $session->id])->with('success', 'La séance a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $session)
    {
        $session->delete();

        return redirect()->route('admin.session.index')->with('success', 'La séance a bien été supprimé');
    }
}
