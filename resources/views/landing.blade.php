<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Focus To-Do - Produktivitas Maksimal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            color: #333;
            overflow-x: hidden;
        }

        header {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.95), rgba(118, 75, 162, 0.95));
            backdrop-filter: blur(10px);
            color: white;
            padding: 80px 20px;
            text-align: center;
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(120, 119, 198, 0.2) 0%, transparent 50%);
            pointer-events: none;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-10px) rotate(1deg); }
            66% { transform: translateY(5px) rotate(-1deg); }
        }

        header h1 {
            font-size: 4rem;
            margin-bottom: 20px;
            font-weight: 700;
            background: linear-gradient(45deg, #fff, #f0f4ff, #fff);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 3s ease-in-out infinite;
            text-shadow: 0 0 30px rgba(255, 255, 255, 0.5);
            position: relative;
            z-index: 2;
        }

        @keyframes shimmer {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        header p {
            font-size: 1.3rem;
            max-width: 700px;
            margin: 0 auto 40px auto;
            opacity: 0.95;
            font-weight: 400;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .cta-buttons {
            margin-top: 40px;
            position: relative;
            z-index: 2;
        }

        .cta-buttons a {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            font-weight: 600;
            padding: 15px 35px;
            border-radius: 50px;
            text-decoration: none;
            margin: 0 15px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: inline-block;
            position: relative;
            overflow: hidden;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .cta-buttons a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .cta-buttons a:hover::before {
            left: 100%;
        }

        .cta-buttons a:hover {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.2));
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .cta-buttons a:active {
            transform: translateY(-1px) scale(1.02);
        }

        /* Demo Hero Section */
        .demo-hero {
            padding: 80px 20px;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .demo-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 30%, rgba(138, 43, 226, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(0, 191, 255, 0.2) 0%, transparent 50%);
            pointer-events: none;
        }

        .demo-container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .demo-title {
            font-size: 2.5rem;
            margin-bottom: 20px;
            background: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientMove 3s ease-in-out infinite;
            font-weight: 700;
        }

        @keyframes gradientMove {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .demo-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 50px;
        }

        .app-mockup {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .mockup-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 30px 25px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .mockup-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px rgba(138, 43, 226, 0.3);
        }

        .mockup-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(138, 43, 226, 0.1), rgba(0, 191, 255, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .mockup-card:hover::before {
            opacity: 1;
        }

        /* Task Card Animation */
        .task-demo {
            position: relative;
            height: 200px;
        }

        .task-item {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 15px;
            padding: 15px;
            margin: 10px 0;
            position: absolute;
            width: 100%;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
            animation: taskFloat 4s ease-in-out infinite;
        }

        .task-item:nth-child(1) { animation-delay: 0s; }
        .task-item:nth-child(2) { animation-delay: 1s; top: 60px; }
        .task-item:nth-child(3) { animation-delay: 2s; top: 120px; }

        @keyframes taskFloat {
            0%, 100% { transform: translateX(0) rotate(0deg); opacity: 1; }
            25% { transform: translateX(10px) rotate(1deg); }
            50% { transform: translateX(-5px) rotate(-0.5deg); }
            75% { transform: translateX(8px) rotate(0.5deg); }
        }

        .task-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .task-checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            position: relative;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .task-text {
            color: white;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .task-priority {
            background: rgba(255, 255, 255, 0.2);
            padding: 4px 8px;
            border-radius: 8px;
            font-size: 0.7rem;
            color: white;
        }

        /* Report Chart Animation */
        .report-demo {
            position: relative;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .chart-container {
            position: relative;
            width: 120px;
            height: 120px;
        }

        .chart-circle {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 8px solid rgba(255, 255, 255, 0.2);
            border-top: 8px solid #ff6b6b;
            border-right: 8px solid #4ecdc4;
            border-bottom: 8px solid #45b7d1;
            animation: chartSpin 3s ease-in-out infinite;
        }

        @keyframes chartSpin {
            0% { transform: rotate(0deg) scale(1); }
            50% { transform: rotate(180deg) scale(1.1); }
            100% { transform: rotate(360deg) scale(1); }
        }

        .chart-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            animation: counterRotate 3s ease-in-out infinite;
        }

        @keyframes counterRotate {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            50% { transform: translate(-50%, -50%) rotate(-180deg); }
            100% { transform: translate(-50%, -50%) rotate(-360deg); }
        }

        /* Timer Animation */
        .timer-demo {
            position: relative;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .timer-display {
            font-size: 3rem;
            font-weight: bold;
            color: #4ecdc4;
            text-shadow: 0 0 20px rgba(78, 205, 196, 0.5);
            animation: timerGlow 2s ease-in-out infinite alternate;
            margin-bottom: 20px;
        }

        @keyframes timerGlow {
            0% { 
                text-shadow: 0 0 20px rgba(78, 205, 196, 0.5);
                transform: scale(1);
            }
            100% { 
                text-shadow: 0 0 30px rgba(78, 205, 196, 0.8), 0 0 40px rgba(78, 205, 196, 0.3);
                transform: scale(1.05);
            }
        }

        .timer-progress {
            width: 200px;
            height: 8px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            overflow: hidden;
            position: relative;
        }

        .timer-bar {
            height: 100%;
            background: linear-gradient(90deg, #ff6b6b, #4ecdc4);
            border-radius: 4px;
            animation: timerProgress 25s linear infinite;
        }

        @keyframes timerProgress {
            0% { width: 0%; }
            50% { width: 75%; }
            100% { width: 100%; }
        }

        .mockup-label {
            text-align: center;
            margin-top: 20px;
            font-weight: 600;
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
        }

        section.features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 100px 20px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.95) 0%, rgba(240, 244, 255, 0.8) 100%);
            backdrop-filter: blur(10px);
            position: relative;
        }

        section.features::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 70% 20%, rgba(102, 126, 234, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 20% 80%, rgba(118, 75, 162, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .feature-box {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(240, 244, 255, 0.8));
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin: 20px;
            padding: 40px 30px;
            border-radius: 25px;
            width: 320px;
            box-shadow: 
                0 20px 40px rgba(102, 126, 234, 0.1),
                0 8px 16px rgba(0, 0, 0, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            text-align: center;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .feature-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.05), rgba(118, 75, 162, 0.05));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .feature-box:hover::before {
            opacity: 1;
        }

        .feature-box:hover {
            transform: translateY(-15px) scale(1.03);
            box-shadow: 
                0 30px 60px rgba(102, 126, 234, 0.2),
                0 15px 30px rgba(0, 0, 0, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            border-color: rgba(102, 126, 234, 0.2);
        }

        .feature-box h3 {
            background: linear-gradient(135deg, #4a56e2, #667eea);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 20px;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .feature-box p {
            color: #555;
            font-size: 1rem;
            line-height: 1.7;
            opacity: 0.9;
        }

        footer {
            background: linear-gradient(135deg, #2d3748, #1a202c);
            color: rgba(255, 255, 255, 0.9);
            text-align: center;
            padding: 40px 20px;
            font-size: 0.95rem;
            position: relative;
            backdrop-filter: blur(10px);
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.5), transparent);
        }

        @media (max-width: 768px) {
            header h1 { 
                font-size: 2.8rem;
                margin-bottom: 15px;
            }
            
            header p {
                font-size: 1.1rem;
                margin-bottom: 30px;
            }
            
            .cta-buttons a {
                padding: 12px 25px;
                margin: 5px 8px;
                font-size: 0.95rem;
            }
            
            .feature-box { 
                width: 100%; 
                max-width: 400px;
                margin: 15px 10px;
                padding: 35px 25px;
            }
            
            section.features {
                padding: 60px 15px;
            }
            
            .demo-hero {
                padding: 60px 15px;
            }
            
            .demo-title {
                font-size: 2rem;
            }
            
            .app-mockup {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .timer-display {
                font-size: 2.5rem;
            }
            
            .timer-progress {
                width: 150px;
            }
        }

        @media (max-width: 480px) {
            header {
                padding: 60px 15px;
            }
            
            header h1 {
                font-size: 2.2rem;
            }
            
            header p {
                font-size: 1rem;
            }
            
            .cta-buttons a {
                display: block;
                margin: 10px auto;
                width: fit-content;
            }
        }
    </style>
</head>
<body>

    <header>
        <h1>Focus To-Do</h1>
        <p>Kelola tugas, tingkatkan fokus, dan capai targetmu dengan lebih terstruktur dan efisien.</p>
        <div class="cta-buttons">
            <a href="{{ route('register') }}">Daftar Sekarang</a>
            <a href="{{ route('login') }}">Masuk</a>
        </div>
    </header>

    <div class="demo-hero">
        <div class="demo-container">
            <h2 class="demo-title">Lihat Focus To-Do Beraksi</h2>
            <p class="demo-subtitle">Kelola tugas, lacak produktivitas, dan tingkatkan fokus dengan interface yang intuitif</p>
            
            <div class="app-mockup">
                <div class="mockup-card">
                    <div class="task-demo">
                        <div class="task-item">
                            <div class="task-content">
                                <div class="task-checkbox"></div>
                                <span class="task-text">Belajar Pemrograman</span>
                                <span class="task-priority">High</span>
                            </div>
                        </div>
                        <div class="task-item">
                            <div class="task-content">
                                <div class="task-checkbox"></div>
                                <span class="task-text">Meeting Project</span>
                                <span class="task-priority">Medium</span>
                            </div>
                        </div>
                        <div class="task-item">
                            <div class="task-content">
                                <div class="task-checkbox"></div>
                                <span class="task-text">Review Code</span>
                                <span class="task-priority">Low</span>
                            </div>
                        </div>
                    </div>
                    <div class="mockup-label">📋 Task Management</div>
                </div>
                
                <div class="mockup-card">
                    <div class="report-demo">
                        <div class="chart-container">
                            <div class="chart-circle"></div>
                            <div class="chart-center">85%</div>
                        </div>
                    </div>
                    <div class="mockup-label">📊 Progress Report</div>
                </div>
                
                <div class="mockup-card">
                    <div class="timer-demo">
                        <div class="timer-display">25:00</div>
                        <div class="timer-progress">
                            <div class="timer-bar"></div>
                        </div>
                    </div>
                    <div class="mockup-label">🕒 Pomodoro Timer</div>
                </div>
            </div>
        </div>
    </div>

    <section class="features">
        <div class="feature-box">
            <h3>📋 Manajemen Tugas</h3>
            <p>Buat, atur, dan tandai tugasmu dengan mudah dan cepat.</p>
        </div>
        <div class="feature-box">
            <h3>🕒 Timer Fokus</h3>
            <p>Gunakan teknik Pomodoro untuk fokus tanpa distraksi.</p>
        </div>
        <div class="feature-box">
            <h3>📊 Statistik Produktivitas</h3>
            <p>Lihat laporan mingguan dan analisis hasil kerjamu.</p>
        </div>
    </section>

    <footer>
        &copy; {{ date('Y') }} Focus To-Do. Dibuat dengan ❤️ untuk kamu yang produktif.
    </footer>

</body>
</html>
