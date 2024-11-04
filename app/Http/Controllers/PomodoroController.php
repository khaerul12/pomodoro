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

    public function store(Request $request)
    {
        $request->validate(['duration' => 'required|integer']);
        PomodoroSession::create($request->all());
        return redirect()->back();
    }
}
