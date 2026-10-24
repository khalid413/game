<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::with('members')->latest()->get();
        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'members' => ['required', 'array', 'min:1'],
            'members.*' => ['required', 'string', 'max:255'],
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('teams', 'public');
        }

        $team = Team::create([
            'name' => $request->name,
            'image' => $imagePath,
        ]);

        foreach ($request->members as $memberName) {
            $team->members()->create([
                'name' => $memberName,
            ]);
        }

        return redirect()->route('teams.index')->with('success', 'Team created successfully.');
    }

    public function edit(Team $team)
    {
        $team->load('members');
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'members' => ['required', 'array', 'min:1'],
            'members.*' => ['required', 'string', 'max:255'],
        ]);

        $imagePath = $team->image;

        if ($request->hasFile('image')) {
            if ($team->image && Storage::disk('public')->exists($team->image)) {
                Storage::disk('public')->delete($team->image);
            }

            $imagePath = $request->file('image')->store('teams', 'public');
        }

        $team->update([
            'name' => $request->name,
            'image' => $imagePath,
        ]);

        $team->members()->delete();

        foreach ($request->members as $memberName) {
            $team->members()->create([
                'name' => $memberName,
            ]);
        }

        return redirect()->route('teams.index')->with('success', 'Team updated successfully.');
    }

    public function destroy(Team $team)
    {
        if ($team->image && Storage::disk('public')->exists($team->image)) {
            Storage::disk('public')->delete($team->image);
        }

        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Team deleted successfully.');
    }
}