<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pomodoro;
use Illuminate\Support\Facades\Auth;

class PomodoroController extends Controller
{
    public function store(Request $request)
    {
        Pomodoro::create([
            'user_id' => Auth::id(),
            'duration' => $request->input('duration'),
            'completed_at' => $request->input('completed_at'),
        ]);

        return redirect('/dashboard')->with('success', 'Sesi fokus disimpan!');
    }
}
