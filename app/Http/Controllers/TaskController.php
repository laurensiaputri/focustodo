<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TaskController extends Controller
{
    // Tampilkan Dashboard
    public function index()
    {
        $todoTasks = Task::where('status', 'todo')->get();
        $inProgressTasks = Task::where('status', 'in_progress')->get();
        $completedTasks = Task::where('status', 'completed')->get();

        // Notifikasi deadline H-0 s.d. H-3
        $notifTasksRaw = [];
        foreach ($todoTasks as $task) {
            if ($task->deadline) {
                $selisih = Carbon::today()->diffInDays(Carbon::parse($task->deadline), false);
                if ($selisih >= 0 && $selisih <= 3) {
                    $notifTasksRaw[$selisih][] = [
                        'title' => $task->title,
                        'days' => $selisih,
                    ];
                }
            }
        }

        // Ambil maksimal 1 notifikasi per hari (H-0 sampai H-3)
        $notifTasks = [];
        foreach ($notifTasksRaw as $tasks) {
            $notifTasks[] = $tasks[0];
        }

        // Kalender Event
        $calendarEvents = Task::whereNotNull('deadline')->get()->map(function ($task) {
            return [
                'title' => $task->title,
                'start' => $task->deadline,
                'color' => match ($task->priority) {
                    'High' => 'red',
                    'Medium' => 'orange',
                    default => 'green',
                },
            ];
        });

        return view('dashboard.dashboard', compact(
            'todoTasks',
            'inProgressTasks',
            'completedTasks',
            'calendarEvents',
            'notifTasks'
        ));
    }

    // Simpan tugas baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:High,Medium,Low',
            'category' => 'required|in:Sekolah,Study,Pekerjaan,Personal',
            'deadline' => 'nullable|date',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'category' => $request->category,
            'deadline' => $request->deadline,
            'status' => 'todo',
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan ke To-Do List!');
    }

    // Drag & Drop via fetch/AJAX
    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:todo,in_progress,completed',
            ]);

            $task = Task::findOrFail($id);
            $task->update(['status' => $request->status]);

            return response()->json(['message' => 'Status tugas diperbarui!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memperbarui status.'], 500);
        }
    }

    // Manual via tombol biasa
    public function updateStatusManual(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:todo,in_progress,completed',
        ]);

        $task = Task::findOrFail($id);
        $task->update(['status' => $request->status]);

        return redirect()->route('dashboard')->with('success', 'Status tugas diperbarui!');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    // Simpan hasil edit tugas
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:High,Medium,Low',
            'category' => 'required|in:Sekolah,Study,Pekerjaan,Personal',
            'deadline' => 'nullable|date',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Tugas berhasil diperbarui.');
    }

    // Hapus tugas
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->back()->with('success', 'Tugas berhasil dihapus.');
    }

    // Grafik garis laporan tugas mingguan
public function chartData()
{
    $tasks = DB::table('tasks')
        ->select(DB::raw('DAYNAME(created_at) as day'), DB::raw('count(*) as total'))
        ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
        ->groupBy('day')
        ->get();

    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    $mapped = array_fill_keys($daysOfWeek, 0);

    foreach ($tasks as $task) {
        $mapped[$task->day] = $task->total;
    }

    return response()->json(array_values($mapped));
}


    // Halaman kalender tugas
    public function calendar()
    {
        $events = Task::whereNotNull('deadline')->get()->map(function ($task) {
            return [
                'title' => $task->title . ' (' . $task->priority . ')',
                'start' => $task->deadline,
                'color' => match ($task->priority) {
                    'High' => '#e74c3c',
                    'Medium' => '#f39c12',
                    'Low' => '#2ecc71',
                    default => '#3498db',
                },
                'url' => route('tasks.edit', $task->id),
            ];
        });

        return view('calendar.calendar', ['events' => $events]);
    }

    // Update deadline dari kalender
    public function updateDeadline(Request $request, $id)
    {
        $request->validate([
            'deadline' => 'required|date',
        ]);

        $task = Task::findOrFail($id);
        $task->deadline = $request->deadline;
        $task->save();

        return response()->json(['success' => true]);
    }
}
