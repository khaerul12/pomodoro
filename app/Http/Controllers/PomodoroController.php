<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Pomodoro;
use App\Models\PomodoroSession;
use Illuminate\Http\Request;

class PomodoroController extends Controller
{
    public function index()
    {
        $sessions = PomodoroSession::all();
        return view('pomodoro.index', compact('sessions'));
    }

    public function store(Request $request)
    {
        $request->validate(['duration' => 'required|integer']);
        PomodoroSession::create($request->all());
        return redirect()->back();
    }
    
    public function destroy($id)
    {
        $session = Pomodoro::findOrFail($id);
        $session->delete();

        return redirect()->route('pomodoro.index')->with('success', 'Session deleted successfully.');
    }
}
