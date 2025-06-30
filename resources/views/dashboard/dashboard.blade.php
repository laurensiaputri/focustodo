<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Original styles enhanced with modern design */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
            padding: 20px;
            margin: 0;
            min-height: 100vh;
            color: #2d3748;
        }

        /* Enhanced Top Bar */
        .top-bar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            margin-bottom: 30px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 15px 25px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .top-bar a,
        .top-bar form button {
            padding: 12px 20px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .top-bar a::before,
        .top-bar form button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .top-bar a:hover::before,
        .top-bar form button:hover::before {
            left: 100%;
        }

        .calendar-btn { 
            background: linear-gradient(135deg, #ffd89b, #19547b);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 216, 155, 0.4);
        }
        
        .report-btn { 
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            color: white;
            box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
        }
        
        .focus-btn { 
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            color: white;
            box-shadow: 0 4px 15px rgba(67, 233, 123, 0.4);
        }
        
        .logout-btn { 
            background: linear-gradient(135deg, #fa709a, #fee140);
            color: white;
            box-shadow: 0 4px 15px rgba(250, 112, 154, 0.4);
        }

        .top-bar a:hover,
        .top-bar form button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* Enhanced Dashboard Title */
        .dashboard-title {
            text-align: center;
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 40px;
            background: linear-gradient(135deg, #fff, #f8f9ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 4px 20px rgba(255, 255, 255, 0.3);
            position: relative;
        }

        .dashboard-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 2px;
        }

        /* Enhanced Form Section */
        h3 {
            color: white;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        form {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 30px;
        }

        form select,
        form input[type="text"],
        form textarea,
        form input[type="date"] {
            width: 100%;
            padding: 15px 20px;
            margin-bottom: 15px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            font-family: inherit;
            transition: all 0.3s ease;
            background: white;
        }

        form select:focus,
        form input[type="text"]:focus,
        form textarea:focus,
        form input[type="date"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }

        form textarea {
            resize: vertical;
            min-height: 100px;
        }

        form button[type="submit"] {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            position: relative;
            overflow: hidden;
        }

        form button[type="submit"]::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        form button[type="submit"]:hover::before {
            left: 100%;
        }

        form button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
        }

        /* Enhanced Board */
        .board {
            display: flex;
            gap: 25px;
            margin-top: 30px;
        }

        .column {
            flex: 1;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            min-height: 500px;
            position: relative;
        }

        .column::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            border-radius: 20px 20px 0 0;
        }

        .column:nth-child(1)::before {
            background: linear-gradient(135deg, #ff6b6b, #ee5a52);
        }

        .column:nth-child(2)::before {
            background: linear-gradient(135deg, #4ecdc4, #44a08d);
        }

        .column:nth-child(3)::before {
            background: linear-gradient(135deg, #45b7d1, #96c93d);
        }

        .column:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
        }

        .column h3 {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 25px;
            padding: 15px 0;
            border-bottom: 2px solid #f1f5f9;
            color: #2d3748;
            text-shadow: none;
            position: relative;
        }

        .column:nth-child(1) h3 {
            color: #ff6b6b;
        }

        .column:nth-child(2) h3 {
            color: #4ecdc4;
        }

        .column:nth-child(3) h3 {
            color: #45b7d1;
        }

        /* Enhanced Tasks */
        .task {
            background: white;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 15px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: grab;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            border-left: 4px solid #e2e8f0;
            position: relative;
            overflow: hidden;
        }

        .task::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .task:hover::before {
            transform: scaleX(1);
        }

        .task:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .task:active {
            cursor: grabbing;
            transform: rotate(2deg) scale(1.02);
        }

        /* Priority-based styling */
        .task[style*="ffe5e5"] {
            border-left-color: #ff6b6b;
            background: linear-gradient(135deg, #fff5f5, #ffffff) !important;
        }

        .task[style*="e5fff1"] {
            border-left-color: #ffd93d;
            background: linear-gradient(135deg, #fffdf0, #ffffff) !important;
        }

        .task[style*="#fff"] {
            border-left-color: #6bcf7f;
            background: linear-gradient(135deg, #f0fff4, #ffffff) !important;
        }

        .task-title {
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 8px;
            color: #2d3748;
        }

        .task div:not(.task-title) {
            font-size: 14px;
            color: #718096;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .task div:last-child {
            margin-top: 15px;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        /* Enhanced Task Buttons */
        .task a,
        .task button {
            padding: 8px 12px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            position: relative;
            overflow: hidden;
        }

        .task a::before,
        .task button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.3);
            transition: left 0.3s;
        }

        .task a:hover::before,
        .task button:hover::before {
            left: 100%;
        }

        .task a[style*="ffc107"] {
            background: linear-gradient(135deg, #ffd89b, #19547b) !important;
            color: white !important;
        }

        .task button[style*="dc3545"] {
            background: linear-gradient(135deg, #fa709a, #fee140) !important;
            color: white !important;
        }

        .task button[style*="007bff"] {
            background: linear-gradient(135deg, #4facfe, #00f2fe) !important;
            color: white !important;
        }

        .task button[style*="28a745"] {
            background: linear-gradient(135deg, #43e97b, #38f9d7) !important;
            color: white !important;
        }

        .task a:hover,
        .task button:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Drag and Drop Effects */
        .column[ondragover] {
            transition: all 0.3s ease;
        }

        .column[ondragover]:hover {
            background: rgba(102, 126, 234, 0.05);
            border: 2px dashed #667eea;
        }

        /* Loading states and animations */
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .task.loading {
            animation: pulse 2s infinite;
        }

        /* Responsive enhancements */
        @media (max-width: 1024px) {
            .board {
                flex-direction: column;
                gap: 20px;
            }
            
            .column {
                min-height: auto;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .top-bar {
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }

            .dashboard-title {
                font-size: 32px;
            }

            form {
                padding: 20px;
            }

            .task div:last-child {
                flex-direction: column;
                gap: 5px;
            }

            .task a,
            .task button {
                width: 100%;
                justify-content: center;
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a6fd8, #6a4190);
        }

        /* Enhanced SweetAlert2 styling */
        .swal2-popup {
            border-radius: 20px !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
        }

        .swal2-confirm {
            background: linear-gradient(135deg, #667eea, #764ba2) !important;
            border-radius: 10px !important;
        }

        .swal2-cancel {
            background: linear-gradient(135deg, #fa709a, #fee140) !important;
            border-radius: 10px !important;
        }

        /* Focus styles for accessibility */
        .task:focus,
        .top-bar a:focus,
        .top-bar button:focus,
        form input:focus,
        form select:focus,
        form textarea:focus,
        form button:focus {
            outline: 3px solid rgba(102, 126, 234, 0.5);
            outline-offset: 2px;
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            body {
                background: #000;
                color: #fff;
            }
            
            .column,
            form {
                background: #fff;
                color: #000;
                border: 2px solid #000;
            }
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* Print styles */
        @media print {
            body {
                background: white;
                color: black;
            }
            
            .top-bar,
            .task a,
            .task button {
                display: none;
            }
            
            .column {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #ccc;
            }
        }
    </style>
</head>
<body>
    
<!-- Bar Navigasi -->
<div class="top-bar">
    <a href="{{ route('calendar') }}" class="calendar-btn">📅 Kalender</a>
    <a href="{{ route('report') }}" class="report-btn">📊 Laporan</a>
    <a href="{{ route('focus') }}" class="focus-btn">🎯 Mode Fokus</a>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">🔓 Logout</button>
    </form>
</div>

<!-- Judul -->
<h2 class="dashboard-title">Dashboard Tugas</h2>

<!-- Form Tambah -->
<h3>Tambah Tugas</h3>
<form action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Judul Tugas" required>
    <textarea name="description" placeholder="Deskripsi"></textarea>
    <select name="priority">
        <option value="High">Prioritas Tinggi</option>
        <option value="Medium">Prioritas Sedang</option>
        <option value="Low">Prioritas Rendah</option>
    </select>
    <select name="category">
        <option value="Sekolah">Sekolah</option>
        <option value="Pekerjaan">Pekerjaan</option>
        <option value="Study">Study</option>
        <option value="Personal">Personal</option>
    </select>
    <input type="date" name="deadline">
    <input type="hidden" name="status" value="todo">
    <button type="submit">Tambah</button>
</form>

<!-- Task Board -->
<div class="board">

    <!-- TO DO -->
    <div class="column" ondragover="event.preventDefault()" ondrop="drop(event, 'todo')">
        <h3>To Do</h3>
        @foreach($todoTasks as $task)
        <div class="task" draggable="true" ondragstart="drag(event, '{{ $task->id }}')"
            style="background-color:
                @if ($task->priority === 'High') #ffe5e5
                @elseif ($task->priority === 'Medium') #e5fff1
                @else #fff
                @endif;">
            <div class="task-title">
                @if ($task->priority === 'High') 📌 @endif
                {{ $task->title }}
            </div>
            <div>{{ $task->priority }} | {{ $task->category }}</div>
            <div>Deadline: {{ $task->deadline }}</div>
            <div style="margin-top: 8px;">
                <a href="{{ route('tasks.edit', $task->id) }}" 
                   style="padding: 4px 10px; font-size: 13px; background: #ffc107; color: white; border-radius: 5px; text-decoration: none;">Edit</a>

                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            style="padding: 4px 10px; font-size: 13px; background: #dc3545; color: white; border: none; border-radius: 5px;">Hapus</button>
                </form>

<form action="{{ route('tasks.updateStatusManual', $task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="status" value="in_progress">
                    <button type="submit" 
                            style="padding: 4px 10px; font-size: 13px; background: #007bff; color: white; border: none; border-radius: 5px;">Pindah ke Progress</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- IN PROGRESS -->
    <div class="column" ondragover="event.preventDefault()" ondrop="drop(event, 'in_progress')">
        <h3>In Progress</h3>
        @foreach($inProgressTasks as $task)
        <div class="task" draggable="true" ondragstart="drag(event, '{{ $task->id }}')">
            <div class="task-title">{{ $task->title }}</div>
            <div>{{ $task->priority }} | {{ $task->category }}</div>
            <div>Deadline: {{ $task->deadline }}</div>
            <div style="margin-top: 8px;">
                <a href="{{ route('tasks.edit', $task->id) }}" 
                   style="padding: 4px 10px; font-size: 13px; background: #ffc107; color: white; border-radius: 5px; text-decoration: none;">Edit</a>

                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            style="padding: 4px 10px; font-size: 13px; background: #dc3545; color: white; border: none; border-radius: 5px;">Hapus</button>
                </form>

<form action="{{ route('tasks.updateStatusManual', $task->id) }}" method="POST" style="display:inline;">
    @csrf
    <input type="hidden" name="status" value="completed">
    <button type="submit" 
            style="padding: 4px 10px; font-size: 13px; background: #28a745; color: white; border: none; border-radius: 5px;">Selesaikan</button>
</form>
   </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- COMPLETED -->
    <div class="column" ondragover="event.preventDefault()" ondrop="drop(event, 'completed')">
        <h3>Completed</h3>
        @foreach($completedTasks as $task)
        <div class="task" draggable="true" ondragstart="drag(event, '{{ $task->id }}')">
            <div class="task-title">{{ $task->title }}</div>
            <div>{{ $task->priority }} | {{ $task->category }}</div>
            <div>Deadline: {{ $task->deadline }}</div>
            <div style="margin-top: 8px;">
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus tugas ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            style="padding: 4px 10px; font-size: 13px; background: #dc3545; color: white; border: none; border-radius: 5px;">Hapus</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

</div>

<!-- SCRIPT NOTIF DEADLINE -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let delay = 0;
        @foreach ($notifTasks as $task)
            setTimeout(() => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: `⏰ {{ $task['title'] }} akan jatuh tempo dalam {{ $task['days'] }} hari!`,
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true
                });
            }, delay);
            delay += 4500;
        @endforeach
    });

    function drag(event, taskId) {
        event.dataTransfer.setData("text/plain", taskId);
    }

    function drop(event, status) {
        event.preventDefault();
        const taskId = event.dataTransfer.getData("text/plain");

        // Make an AJAX request to update the task's status
        fetch(`/tasks/${taskId}/updateStatus`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => {
            if (response.ok) {
                location.reload(); // Reload the page to see changes
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session("success") }}',
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif

</body>
</html>