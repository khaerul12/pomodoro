<?php

namespace App\Http\Controllers;

use App\Models\PomodoroSession;
use Illuminate\Http\Request;

class PomodoroController extends Controller
{
    public function index()
    {
        $sessions = PomodoroSession::all();
        return view('pomodoro.index', compact('sessions'));
    }

    public function create()
    {
        return view('pomodoro.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'duration' => 'required|integer'
        ]);

        PomodoroSession::create($request->all());

        return redirect()->route('pomodoro.index');
    }

    public function show(PomodoroSession $pomodoro)
    {
        return view('pomodoro.show', compact('pomodoro'));
    }

    public function edit(PomodoroSession $pomodoro)
    {
        return view('pomodoro.edit', compact('pomodoro'));
    }

    public function update(Request $request, PomodoroSession $pomodoro)
    {
        $request->validate([
            'duration' => 'required|integer'
        ]);

        $pomodoro->update($request->all());

        return redirect()->route('pomodoro.index');
    }

    public function destroy(PomodoroSession $pomodoro)
    {
        $pomodoro->delete();

        return redirect()->route('pomodoro.index');
    }
}