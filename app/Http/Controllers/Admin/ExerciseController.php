<?php

namespace App\Http\Controllers\Admin;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ExerciseRequest;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $exercises = Exercise::all();

        return view('admin.exercise.index', [
            'exercises' => $exercises
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $exercise = new Exercise();

        return view('admin.exercise.form', [
            'exercise' => $exercise
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExerciseRequest $request)
    {
        $exercise = Exercise::create($request->validated());

        /** @var UploadedFile|null $image */
        $image = $request->validated('image');
        if ($image != null && !$image->getError()){
            $data['image'] = $image->store('exercise', 'public');
            $exercise->update($data);
        }

        return to_route('exercise.index')->with('success', 'L\'exercice a bien été créé');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercise $exercise)
    {
        return view('admin.exercise.show', [
            'exercise' => $exercise
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exercise $exercise)
    {
        return view('admin.exercise.form', [
            'exercise' => $exercise
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExerciseRequest $request, Exercise $exercise)
    {
        $exercise->update($request->validated());

        /** @var UploadedFile|null $image */
        $image = $request->validated('image');
        if ($image != null && !$image->getError()){
            $data['image'] = $image->store('exercise', 'public');
            $exercise->update($data);
        }

        return redirect()->route('exercise.show', ['exercise' => $exercise->id])->with('success', 'L\'exercice a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise)
    {
        $exercise->delete();

        return redirect()->route('exercise.index')->with('success', 'L\'exercice a bien été supprimé');
    }
}
