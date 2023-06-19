<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TipsRequest;
use App\Models\Tip;
use Illuminate\Routing\Controller;

class TipController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tips = Tip::all();

        return view('admin.tips.index', [
            'tips' => $tips
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tip = new Tip();

        return view('admin.tips.form', [
            'tip' => $tip
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TipsRequest $request)
    {
        $tip = Tip::create($request->validated());

        return to_route('admin.tips.index')->with('success', 'Le conseil a bien été créé');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tip $tip)
    {
        return view('admin.tips.show', [
            'exercise' => $tip
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tip $tip)
    {
        return view('admin.tips.form', [
            'exercise' => $tip
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TipsRequest $request, Tip $tip)
    {
        $tip->update($request->validated());

        return redirect()->route('admin.tips.show', ['tip' => $tip->id])->with('success', 'Le conseil a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tip $tip)
    {
        $tip->delete();

        return redirect()->route('admin.tips.index')->with('success', 'Le conseil a bien été supprimé');
    }
}
