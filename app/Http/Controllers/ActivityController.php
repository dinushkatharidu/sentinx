<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Target;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('activities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Target $target)
    {

        $validated = $request->validate([
            'note' => 'required|string|max:1000',
        ]);

        $target->activities()->create([
            'note' => $validated['note']
        ]);

        return redirect()->route('targets.show', $target->id)->with('success', 'Investigation log updated.');

    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $id)
    {

    }


    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }



}





