<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Pomodoro;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('category');

        // Ambil data tugas berdasarkan kategori (jika difilter)
        $tasks = Task::when($filter, function ($query) use ($filter) {
            return $query->where('category', $filter);
        })->get();

        // Hitung jumlah status berdasarkan filter kategori juga
        $todo = Task::when($filter, fn($q) => $q->where('category', $filter))
            ->where('status', 'todo')->count();

        $inProgress = Task::when($filter, fn($q) => $q->where('category', $filter))
            ->where('status', 'in_progress')->count();

        $completed = Task::when($filter, fn($q) => $q->where('category', $filter))
            ->where('status', 'completed')->count();

        // Statistik Pomodoro Hari Ini
        $userId = Auth::id();
        $today = Carbon::today();

        $jumlahSesiHariIni = Pomodoro::where('user_id', $userId)
            ->whereDate('completed_at', $today)
            ->count();

        // Statistik Mingguan Pomodoro
        $pomodoros = Pomodoro::where('user_id', $userId)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->get();

        $pomodoroData = [];
        foreach ($pomodoros as $p) {
            $day = Carbon::parse($p->created_at)->format('l');
            $pomodoroData[$day] = ($pomodoroData[$day] ?? 0) + $p->duration;
        }

        return view('report.index', compact(
            'tasks',
            'todo',
            'inProgress',
            'completed',
            'filter',
            'jumlahSesiHariIni',
            'pomodoroData'
        ));
    }
}

