<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kalender Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
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
            padding: 30px 20px;
        }

        .calendar-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            color: white;
            font-size: 2.5rem;
            margin-bottom: 40px;
            font-weight: 700;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            letter-spacing: -1px;
        }

        #calendar {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 25px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: visible;
            min-height: 600px;
            z-index: 1;
        }

        #calendar::before {
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

        /* Custom FullCalendar Styling */
        .fc {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .fc-toolbar {
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .fc-toolbar-title {
            font-size: 1.8rem !important;
            font-weight: 700 !important;
            color: #333 !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .fc-button {
            background: linear-gradient(45deg, #667eea, #764ba2) !important;
            border: none !important;
            border-radius: 10px !important;
            padding: 8px 16px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3) !important;
        }

        .fc-button:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4) !important;
        }

        a:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}


        .fc-button:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3) !important;
        }

        .fc-daygrid-day:hover {
            background-color: rgba(102, 126, 234, 0.1) !important;
        }

        .fc-daygrid-day-number {
            font-weight: 600;
            color: #333;
            padding: 8px;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 5px;
        }

        .fc-day-today .fc-daygrid-day-number {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .fc-event {
            border: none !important;
            border-radius: 8px !important;
            padding: 4px 8px !important;
            font-weight: 600 !important;
            font-size: 0.85rem !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
        }

        .fc-event:hover {
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2) !important;
        }

        .fc-col-header-cell {
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
            font-weight: 700;
            color: #333;
            padding: 15px 5px;
            border-bottom: 2px solid #dee2e6;
        }

        .fc-scrollgrid {
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid #e9ecef;
        }
    </style>
</head>
<body>
    <div style="margin-bottom: 20px; text-align: center;">
    <a href="{{ route('dashboard') }}"
       style="text-decoration: none;
              background: linear-gradient(45deg, #667eea, #764ba2);
              padding: 12px 24px;
              color: white;
              border-radius: 30px;
              font-weight: 600;
              box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
              transition: all 0.3s;">
        ⬅️ Kembali ke Dashboard
    </a>
</div>

    <div class="calendar-container">
        <h2>📅 Kalender Tugas</h2>
        <div id="calendar"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            selectable: true,
            height: "auto",

            events: @json($events), // Ambil event dari database Laravel

            dateClick: function(info) {
                const tanggal = info.dateStr;

                // Prompt sederhana, bisa kamu ganti pakai modal
                const title = prompt("Masukkan judul tugas:");
                if (title) {
                    fetch('/tasks', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            title: title,
                            priority: 'Medium', // default, bisa pakai input
                            category: 'Personal',
                            deadline: tanggal
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert("Tugas ditambahkan!");
                            calendar.addEvent({
                                title: title,
                                start: tanggal,
                                backgroundColor: '#36b9cc',
                                borderColor: '#36b9cc'
                            });
                        }
                    });
                }
            },

            eventClick: function(info) {
                if (info.event.url) {
                    window.open(info.event.url, "_blank");
                    info.jsEvent.preventDefault();
                }
            }
        });

        calendar.render();
    });
</script>

</body>
</html>
