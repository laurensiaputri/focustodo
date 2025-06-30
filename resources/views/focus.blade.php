<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mode Fokus - Pomodoro</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            text-align: center;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: float 20s infinite linear;
            pointer-events: none;
        }

        @keyframes float {
            0% { transform: translateX(0) translateY(0); }
            100% { transform: translateX(-50px) translateY(-50px); }
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 30px;
            padding: 50px 40px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 600px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #667eea, #764ba2, #667eea);
            background-size: 200% 100%;
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 40px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
            letter-spacing: -1px;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .duration-selector {
            margin-bottom: 30px;
            padding: 15px 10px;
            background: linear-gradient(145deg, #f8f9ff, #e8eaff);
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .duration-selector label {
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }

        #duration {
            font-size: 0.95rem;
            padding: 8px 15px;
            border: none;
            border-radius: 10px;
            background: white;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            outline: none;
            cursor: pointer;
            font-weight: 600;
            color: #333;
            width: 100%;
            max-width: 150px;
        }

        #duration:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
            transform: translateY(-1px);
        }

        #timer {
            font-size: 6rem;
            margin-bottom: 40px;
            font-weight: 700;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        #progress-container {
            width: 100%;
            height: 12px;
            background: rgba(221, 221, 221, 0.3);
            border-radius: 20px;
            margin: 30px 0;
            overflow: hidden;
        }

        #progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            width: 0%;
            transition: width 1s linear;
            border-radius: 20px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 40px 0;
            flex-wrap: wrap;
        }

        button {
            padding: 12px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        }

        .start { background: linear-gradient(45deg, #28a745, #20c997); color: white; }
        .pause { background: linear-gradient(45deg, #dc3545, #fd7e14); color: white; }
        .reset { background: linear-gradient(45deg, #6c757d, #adb5bd); color: white; }
        .stop { background: linear-gradient(45deg, #343a40, #495057); color: white; }

        .back-link {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 24px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 600;
        }

        .timer-status {
            margin: 20px 0;
            padding: 15px;
            border-radius: 15px;
            font-weight: 600;
            font-size: 1.1rem;
            display: none;
        }

        .timer-status.active { display: block; }

        .timer-status.running { background: rgba(40, 167, 69, 0.1); color: #28a745; }
        .timer-status.paused { background: rgba(220, 53, 69, 0.1); color: #dc3545; }
        .timer-status.completed { background: rgba(102, 126, 234, 0.1); color: #667eea; }

        @media (max-width: 480px) {
            h1 { font-size: 1.8rem; margin-bottom: 20px; }
            #timer { font-size: 3rem; }
            button { width: 100%; max-width: 200px; }
            .duration-selector {
                padding: 10px;
            }
            #duration {
                padding: 6px 12px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎯 Mode Fokus: Pomodoro Timer</h1>

        <div class="duration-selector">
            <label for="duration">Pilih Durasi:</label>
            <select id="duration" onchange="setDuration()">
                <option value="20">20 Menit</option>
                <option value="45">45 Menit</option>
            </select>
        </div>

        <div id="timer">20:00</div>

        <div id="progress-container">
            <div id="progress-bar"></div>
        </div>

        <div class="timer-status" id="timer-status"></div>

        <div class="button-container">
            <button class="start" onclick="startTimer()">▶️ Mulai</button>
            <button class="pause" onclick="pauseTimer()">⏸️ Jeda</button>
            <button class="stop" onclick="stopTimer()">⏹️ Stop</button>
            <button class="reset" onclick="resetTimer()">🔄 Reset</button>
        </div>

        <a href="/dashboard" class="back-link">← Kembali ke Dashboard</a>
    </div>

    <form id="pomodoro-form" method="POST" action="/pomodoro/selesai" style="display: none;">
        @csrf
        <input type="hidden" name="duration" id="durationInput">
        <input type="hidden" name="completed_at" id="completedAtInput">
    </form>

    <script>
        let totalSeconds = 20 * 60;
        let remainingSeconds = totalSeconds;
        let interval = null;
        let isRunning = false;

        function updateTimerDisplay() {
            const minutes = Math.floor(remainingSeconds / 60);
            const seconds = remainingSeconds % 60;
            document.getElementById('timer').innerText =
                `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

            const progress = 100 - (remainingSeconds / totalSeconds) * 100;
            document.getElementById('progress-bar').style.width = `${progress}%`;
        }

        function updateStatus(status) {
            const statusEl = document.getElementById('timer-status');
            statusEl.className = 'timer-status active ' + status;
            if (status === 'running') {
                statusEl.innerText = '🔥 Timer sedang berjalan... Tetap fokus!';
            } else if (status === 'paused') {
                statusEl.innerText = '⏸️ Timer dijeda. Siap melanjutkan?';
            } else if (status === 'completed') {
                statusEl.innerText = '🎉 Sesi fokus selesai!';
            }
        }

        function startTimer() {
            if (interval) return;
            isRunning = true;
            updateStatus('running');

            interval = setInterval(() => {
                if (remainingSeconds > 0) {
                    remainingSeconds--;
                    updateTimerDisplay();
                } else {
                    clearInterval(interval);
                    interval = null;
                    isRunning = false;
                    updateStatus('completed');
                    savePomodoro();
                }
            }, 1000);
        }

        function pauseTimer() {
            if (!interval) return;
            clearInterval(interval);
            interval = null;
            isRunning = false;
            updateStatus('paused');
        }

        function stopTimer() {
            clearInterval(interval);
            interval = null;
            isRunning = false;
            remainingSeconds = totalSeconds;
            updateTimerDisplay();
            document.getElementById('progress-bar').style.width = `0%`;
            document.getElementById('timer-status').className = 'timer-status';
        }

        function resetTimer() {
            clearInterval(interval);
            interval = null;
            isRunning = false;
            remainingSeconds = totalSeconds;
            updateTimerDisplay();
            document.getElementById('progress-bar').style.width = `0%`;
            document.getElementById('timer-status').className = 'timer-status';
        }

        function setDuration() {
            const selected = document.getElementById('duration').value;
            totalSeconds = selected * 60;
            remainingSeconds = totalSeconds;
            updateTimerDisplay();
            document.getElementById('progress-bar').style.width = `0%`;
            document.getElementById('timer-status').className = 'timer-status';
        }

        function savePomodoro() {
            const duration = totalSeconds / 60;
            const now = new Date().toISOString();
            document.getElementById('durationInput').value = duration;
            document.getElementById('completedAtInput').value = now;
            document.getElementById('pomodoro-form').submit();
        }

        updateTimerDisplay();
    </script>
</body>
</html>
