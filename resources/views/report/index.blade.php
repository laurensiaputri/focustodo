<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Tugas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
        }

        h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 30px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
            letter-spacing: -1px;
        }

        /* Navigation Styles */
        .nav-container {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .nav-container a, .nav-container button {
            padding: 10px 16px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .nav-container a {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
        }

        .nav-container button {
            background: linear-gradient(45deg, #dc3545, #c82333);
            color: white;
        }

        .nav-container a:hover, .nav-container button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        #chart-container {
            width: 350px;
            height: 350px;
            margin: 0 auto 40px;
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        #chart-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #667eea);
            background-size: 200% 100%;
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        .filter-buttons {
            text-align: center;
            margin-bottom: 40px;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .filter-buttons a {
            padding: 12px 24px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .filter-buttons a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .filter-buttons a:hover::before {
            left: 100%;
        }

        .filter-buttons a:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .tasks-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .tasks-section h3 {
            font-size: 1.8rem;
            margin-bottom: 25px;
            color: #333;
            text-align: center;
            position: relative;
            padding-bottom: 15px;
        }

        .tasks-section h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 2px;
        }

        .task-card {
            border: none;
            padding: 20px;
            margin-bottom: 20px;
            background: linear-gradient(145deg, #f8f9ff, #e8eaff);
            border-radius: 15px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .task-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(45deg, #667eea, #764ba2);
        }

        .task-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .task-card strong {
            font-size: 1.2rem;
            color: #333;
            display: block;
            margin-bottom: 10px;
        }

        .task-card br + text {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .task-category {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .task-category:hover {
            transform: scale(1.05);
        }

        .task-category.sekolah {
            background: linear-gradient(45deg, #f6c23e, #f4a261);
            color: #8b4513;
        }

        .task-category.personal {
            background: linear-gradient(45deg, #36b9cc, #2a9fd6);
            color: #1a4d57;
        }

        .task-category.pekerjaan {
            background: linear-gradient(45deg, #1cc88a, #28a745);
            color: #0d4f3c;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #666;
            font-size: 1.1rem;
        }

        .empty-state::before {
            content: '📋';
            font-size: 4rem;
            display: block;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        /* Chart Section Styling */
        .chart-section {
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .chart-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        /* Line Chart Styles */
        .line-chart-container {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin: 30px 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .line-chart-container h2 {
            font-size: 1.8rem;
            margin-bottom: 30px;
        }

        .chart-container {
            width: 90%;
            margin: auto;
            position: relative;
        }

        /* Pomodoro Chart Styles */
        .pomodoro-section {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin: 30px 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        #pomodoroChart {
            border-radius: 15px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .container {
                padding: 20px;
                margin: 0 10px;
            }
            
            h2 {
                font-size: 2rem;
            }
            
            .filter-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            #chart-container {
                width: 300px;
                height: 300px;
            }
            
            .nav-container {
                position: static;
                justify-content: center;
                margin-bottom: 20px;
            }
        }

        /* Loading Animation */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .loading {
            animation: pulse 2s infinite;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Navigasi Kecil di Pojok Kanan Atas -->
        <div class="nav-container">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit">Keluar</button>
            </form>
        </div>

        <h2>📊 Laporan Tugas</h2>

        <!-- 🔘 Tombol Filter Kategori -->
        <div class="filter-buttons">
            <a href="{{ route('report') }}">✨ Semua</a>
            <a href="{{ route('report', ['category' => 'Sekolah']) }}">🎓 Sekolah</a>
            <a href="{{ route('report', ['category' => 'Personal']) }}">👤 Personal</a>
            <a href="{{ route('report', ['category' => 'Pekerjaan']) }}">💼 Pekerjaan</a>
        </div>

        <!-- 📊 Grafik Tugas -->
        <div class="chart-section">
            <div id="chart-container">
                <canvas id="taskChart"></canvas>
            </div>
        </div>

        <!-- 📋 Daftar Tugas -->
        <div class="tasks-section">
            <h3>📝 Tugas {{ $filter ?? 'Semua Kategori' }}</h3>
            @forelse ($tasks as $task)
                <div class="task-card">
                    <strong>{{ $task->title }}</strong><br>
                    Status: {{ $task->status }}<br>
                    Prioritas: {{ $task->priority }}<br>
                    <span class="task-category {{ strtolower($task->category) }}">{{ $task->category }}</span>
                </div>
            @empty
                <div class="empty-state">
                    Tidak ada tugas untuk kategori ini.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Line Chart Section -->
    <div class="container" style="margin-top: 30px;">
        <div class="line-chart-container">
            <h2>📈 Grafik Garis Jumlah Tugas per Hari</h2>
            <div class="chart-container">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Pomodoro Chart Section -->
    <div class="container" style="margin-top: 30px;">
        <div class="pomodoro-section">
            <h2>🍅 Statistik Pomodoro</h2>
            <canvas id="pomodoroChart" width="400" height="200"></canvas>
        </div>
    </div>

    <!-- 📈 Chart.js Scripts -->
    <script>
        // Pie Chart
        const ctx = document.getElementById('taskChart').getContext('2d');
        const taskChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['To Do', 'In Progress', 'Completed'],
                datasets: [{
                    label: 'Jumlah Tugas',
data: [{{ $todo }}, {{ $inProgress }}, {{ $completed }}],
                    backgroundColor: [
                        'linear-gradient(45deg, #f6c23e, #f4a261)',
                        'linear-gradient(45deg, #36b9cc, #2a9fd6)', 
                        'linear-gradient(45deg, #1cc88a, #28a745)'
                    ],
                    borderColor: ['#fff'],
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: {
                                size: 14,
                                weight: '600'
                            }
                        }
                    }
                }
            }
        });

        // Line Chart
        const labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        const lineData = {
            labels: labels,
            datasets: [{
                label: 'Jumlah Tugas',
                data: [3, 5, 8, 4, 6, 2, 1],
                fill: true,
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                borderColor: '#667eea',
                borderWidth: 3,
                tension: 0.4,
                pointBackgroundColor: '#667eea',
                pointBorderColor: '#fff',
                pointBorderWidth: 3,
                pointRadius: 6
            }]
        };

        const lineConfig = {
            type: 'line',
            data: lineData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 14,
                                weight: '600'
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Tugas',
                            font: {
                                size: 14,
                                weight: '600'
                            }
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Hari',
                            font: {
                                size: 14,
                                weight: '600'
                            }
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    }
                }
            }
        };

        new Chart(document.getElementById('lineChart'), lineConfig);

        // Pomodoro Chart
        const pomodoroData = {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'], // Sample data
            datasets: [{
                label: 'Durasi Fokus (menit)',
                data: [45, 60, 30, 75, 90], // Sample data
                backgroundColor: 'rgba(102, 126, 234, 0.8)',
                borderColor: '#667eea',
                borderWidth: 2,
                borderRadius: 8,
            }]
        };

        new Chart(document.getElementById('pomodoroChart'), {
            type: 'bar',
            data: pomodoroData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 14,
                                weight: '600'
                            }
                        }
                    }
                },
                scales: {
                    y: { 
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
