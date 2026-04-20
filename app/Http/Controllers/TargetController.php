<?php

namespace App\Http\Controllers;

use App\Models\Target;
use Illuminate\Http\Request;

class TargetController extends Controller
{
    public function index(){
        $targets = Target::latest()->get();
        return view('targets.index', compact('targets'));
    }

    public function create(){
        return view('targets.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string||max:255',
            'email' => 'nullable|email',
            'notes' => 'nullable|string',
        ]);

        Target::create($validated);

        return redirect()->route('targets.index')->with('success', 'Target added successfully!');
    }
}
