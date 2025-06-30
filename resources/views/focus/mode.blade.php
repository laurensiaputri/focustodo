<!-- resources/views/focus/mode.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Mode Fokus</title>
    <style>
        body { font-family: Arial; text-align: center; margin-top: 100px; }
        #timer { font-size: 80px; margin: 30px; }
        button { padding: 15px 30px; font-size: 18px; margin: 10px; }
    </style>
</head>
<body>
    <h1>🎯 Fokus Pomodoro</h1>
    <div id="timer">25:00</div>
    <button onclick="startTimer()">Mulai</button>
    <button onclick="resetTimer()">Reset</button>

    <form id="pomodoroForm" action="{{ route('pomodoro.store') }}" method="POST" style="display:none;">
        @csrf
        <input type="hidden" name="duration" id="duration" value="25">
        <input type="hidden" name="completed_at" id="completed_at">
    </form>

    <script>
        let timer;
        let totalSeconds = 25 * 60;

        function startTimer() {
            timer = setInterval(() => {
                if (totalSeconds <= 0) {
                    clearInterval(timer);
                    document.getElementById('completed_at').value = new Date().toISOString();
                    document.getElementById('pomodoroForm').submit();
                } else {
                    totalSeconds--;
                    const minutes = String(Math.floor(totalSeconds / 60)).padStart(2, '0');
                    const seconds = String(totalSeconds % 60).padStart(2, '0');
               A     document.getElementById('timer').innerText = `${minutes}:${seconds}`;
                }
            }, 1000);
        }

        function resetTimer() {
            clearInterval(timer);
            totalSeconds = 25 * 60;
            document.getElementById('timer').innerText = "25:00";
        }
    </script>
</body>
</html>
