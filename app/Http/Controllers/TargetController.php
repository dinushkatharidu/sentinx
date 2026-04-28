<?php

namespace App\Http\Controllers;

use App\Models\Target;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Evidence;


class TargetController extends Controller
{
    public function index()
    {
        $targets = Target::latest()->get();
        return view('targets.index', compact('targets'));
    }

    public function create()
    {
        return view('targets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string||max:255',
            'email' => 'nullable|email',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'evidences.*' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:5120',
        ]);

        $target = Target::create($request->only(['name', 'username', 'email']));


        if ($request->hasFile('evidences')) {
            foreach ($request->file('evidences') as $file) {
                $path = $file->store('evidences', 'public');


                $target->evidences()->create([
                    'file_path' => $path,
                    'file_type' => $file->getClientOriginalExtension(),
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()->route('targets.index')->with('success', 'New Target & Evidence Vault created!');
    }

    public function show(Target $target)
    {
        return view('targets.show', compact('target'));
    }

    public function edit(Target $target)
    {
        return view('targets.edit', compact('target'));
    }

    public function update(Request $request, Target $target)
    {
         $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'status' => 'required|in:pending,active,closed',
            'notes' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'evidences.*' => 'nullable|mimes:jpeg,png,jpg,gif,pdf|max:5120',
        ]);

        $target->update($request->only(['name', 'username', 'email', 'status']));


        if ($request->hasFile('evidences')) {


            foreach ($request->file('evidences') as $file) {


                $path = $file->store('evidences', 'public');


                $target->evidences()->create([
                    'file_path' => $path,
                    'file_type' => $file->getClientOriginalExtension(),
                    'original_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()->route('targets.show', $target->id)->with('success', 'Evidence Vault updated!');
    }

    public function destroy(Target $target)
    {
        $target->delete();
        return redirect()->route('targets.index')->with('success', 'Target erased from records.');
    }

    public function destroyEvidence(Evidence $evidence)
    {

        if (Storage::disk('public')->exists($evidence->file_path)) {
            Storage::disk('public')->delete($evidence->file_path);
        }


        $evidence->delete();

        return back()->with('success', 'Evidence removed from vault.');
    }
}
