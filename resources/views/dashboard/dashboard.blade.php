<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        
        @media (max-width: 480px) {
    .top-bar {
        flex-direction: column;
        align-items: stretch;
        padding: 10px;
        gap: 8px;
    }

    .top-bar a,
    .top-bar form button {
        padding: 10px 12px;
        font-size: 12px;
        gap: 4px;
        justify-content: center;
        text-align: center;
        width: 100%;
    }

    .user-profile {
        flex-direction: column;
        align-items: center;
        text-align: center;
        max-width: 100%;
    }

    .user-profile > div:first-child {
        width: 40px;
        height: 40px;
        font-size: 1.2rem;
    }

    .dashboard-title {
        font-size: 24px;
    }

    h3 {
        font-size: 20px;
    }
}
/* Reset and Base Styles */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c, #4facfe, #00f2fe);
    background-size: 400% 400%;
    animation: gradientShift 25s ease infinite;
    background-attachment: fixed;
    padding: 20px;
    margin: 0;
    min-height: 100vh;
    color: #2d3748;
    position: relative;
    overflow-x: hidden;
}

/* Floating background particles */
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
    animation: float 20s ease-in-out infinite;
    pointer-events: none;
    z-index: -1;
}

@keyframes gradientShift {
    0% { background-position: 0% 50%; }
    25% { background-position: 100% 50%; }
    50% { background-position: 100% 100%; }
    75% { background-position: 0% 100%; }
    100% { background-position: 0% 50%; }
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    33% { transform: translateY(-30px) rotate(2deg); }
    66% { transform: translateY(-15px) rotate(-2deg); }
}

/* User Profile Card (Standalone) */
.user-profile:first-of-type {
    display: flex;
    align-items: center;
    gap: 15px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(25px);
    padding: 20px 25px;
    border-radius: 20px;
    box-shadow: 
        0 25px 50px rgba(0, 0, 0, 0.15),
        0 0 0 1px rgba(255, 255, 255, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.4);
    max-width: 350px;
    margin-bottom: 30px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.4s ease;
    animation: slideInLeft 1s ease-out;
}

.user-profile:first-of-type:hover {
    transform: translateY(-5px);
    box-shadow: 
        0 35px 70px rgba(0, 0, 0, 0.2),
        0 0 0 1px rgba(255, 255, 255, 0.4),
        inset 0 1px 0 rgba(255, 255, 255, 0.5);
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Enhanced Top Bar */
.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    margin-bottom: 40px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(25px);
    padding: 15px 25px;
    border-radius: 20px;
    box-shadow: 
        0 25px 50px rgba(0, 0, 0, 0.15),
        0 0 0 1px rgba(255, 255, 255, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.2);
    flex-wrap: wrap;
    animation: slideInDown 1s ease-out 0.2s both;
    position: relative;
}

.top-bar::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    border-radius: 20px;
    pointer-events: none;
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Top Bar User Profile */
.top-bar .user-profile {
    display: flex;
    align-items: center;
    gap: 12px;
    z-index: 1;
}

.top-bar .user-profile > div:first-child {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    font-weight: bold;
    font-size: 1.2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    text-transform: uppercase;
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    transition: all 0.3s ease;
}

.top-bar .user-profile > div:first-child:hover {
    transform: scale(1.1);
    box-shadow: 0 12px 30px rgba(102, 126, 234, 0.6);
}

/* Top Bar Buttons Container */
.top-bar > div:last-child {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    z-index: 1;
}

/* Enhanced Top Bar Buttons */
.top-bar a,
.top-bar form button {
    padding: 12px 20px;
    border-radius: 15px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    white-space: nowrap;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
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

/* Button Specific Styles */
.calendar-btn { 
    background: linear-gradient(135deg, #ffeaa7, #fab1a0, #e17055);
    color: white;
    box-shadow: 0 8px 25px rgba(255, 202, 40, 0.4);
}

.report-btn { 
    background: linear-gradient(135deg, #74b9ff, #0984e3, #6c5ce7);
    color: white;
    box-shadow: 0 8px 25px rgba(116, 185, 255, 0.4);
}

.focus-btn { 
    background: linear-gradient(135deg, #55efc4, #00b894, #00cec9);
    color: white;
    box-shadow: 0 8px 25px rgba(85, 239, 196, 0.4);
}

.logout-btn { 
    background: linear-gradient(135deg, #fd79a8, #e84393, #f39c12);
    color: white;
    box-shadow: 0 8px 25px rgba(253, 121, 168, 0.4);
}

.top-bar a:hover,
.top-bar form button:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
}

.top-bar a:active,
.top-bar form button:active {
    transform: translateY(-1px) scale(1.02);
}

/* Enhanced Dashboard Title */
.dashboard-title {
    text-align: center;
    font-size: 4rem;
    font-weight: 900;
    margin-bottom: 50px;
    background: linear-gradient(135deg, #fff, #f8f9ff, rgba(255,255,255,0.9));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 8px 30px rgba(255, 255, 255, 0.5);
    position: relative;
    animation: titleFloat 1s ease-out 0.4s both;
    letter-spacing: -2px;
}

.dashboard-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 120px;
    height: 6px;
    background: linear-gradient(135deg, #667eea, #764ba2, #f093fb);
    border-radius: 3px;
    animation: underlineGrow 1s ease-out 0.8s both;
}

@keyframes titleFloat {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes underlineGrow {
    from {
        width: 0;
    }
    to {
        width: 120px;
    }
}

/* Enhanced Section Headers */
h3 {
    color: rgba(255, 255, 255, 0.95);
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 25px;
    text-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
    position: relative;
    animation: fadeInUp 1s ease-out 0.6s both;
}

h3::before {
    content: '✨';
    margin-right: 10px;
    font-size: 1.5rem;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Enhanced Form Section */
form {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(25px);
    padding: 40px;
    border-radius: 25px;
    box-shadow: 
        0 25px 50px rgba(0, 0, 0, 0.15),
        0 0 0 1px rgba(255, 255, 255, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.2);
    margin-bottom: 40px;
    animation: slideInUp 1s ease-out 0.8s both;
    position: relative;
}

form::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    border-radius: 25px;
    pointer-events: none;
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Enhanced Form Inputs */
form select,
form input[type="text"],
form textarea,
form input[type="date"] {
    width: 100%;
    padding: 18px 24px;
    margin-bottom: 20px;
    border: 2px solid rgba(102, 126, 234, 0.2);
    border-radius: 15px;
    font-size: 16px;
    font-family: inherit;
    transition: all 0.4s ease;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.05);
    position: relative;
}

form select:focus,
form input[type="text"]:focus,
form textarea:focus,
form input[type="date"]:focus {
    outline: none;
    border-color: #667eea;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 
        inset 0 2px 8px rgba(0, 0, 0, 0.05),
        0 0 0 4px rgba(102, 126, 234, 0.15),
        0 0 25px rgba(102, 126, 234, 0.3);
    transform: translateY(-2px);
}

form textarea {
    resize: vertical;
    min-height: 120px;
}

/* Enhanced Submit Button */
form button[type="submit"] {
    background: linear-gradient(135deg, #667eea, #764ba2, #f093fb);
    background-size: 200% 200%;
    color: white;
    padding: 18px 40px;
    border: none;
    border-radius: 15px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 700;
    transition: all 0.4s ease;
    box-shadow: 0 15px 35px rgba(102, 126, 234, 0.4);
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
    letter-spacing: 1px;
    width: 100%;
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
    transform: translateY(-3px);
    box-shadow: 0 20px 45px rgba(102, 126, 234, 0.6);
    background-position: 100% 0;
}

/* Enhanced Board */
.board {
    display: flex;
    gap: 30px;
    margin-top: 40px;
    animation: fadeIn 1s ease-out 1s both;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Enhanced Columns */
.column {
    flex: 1;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(25px);
    padding: 30px;
    border-radius: 25px;
    box-shadow: 
        0 25px 50px rgba(0, 0, 0, 0.15),
        0 0 0 1px rgba(255, 255, 255, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.4s ease;
    min-height: 600px;
    position: relative;
    overflow: hidden;
}

.column::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
    border-radius: 25px 25px 0 0;
    transition: all 0.3s ease;
}

.column:nth-child(1)::before {
    background: linear-gradient(135deg, #ff6b6b, #ee5a52, #ff7675);
}

.column:nth-child(2)::before {
    background: linear-gradient(135deg, #4ecdc4, #44a08d, #00cec9);
}

.column:nth-child(3)::before {
    background: linear-gradient(135deg, #45b7d1, #96c93d, #6c5ce7);
}

.column:hover {
    transform: translateY(-8px);
    box-shadow: 
        0 35plus 70px rgba(0, 0, 0, 0.2),
        0 0 0 1px rgba(255, 255, 255, 0.4),
        inset 0 1px 0 rgba(255, 255, 255, 0.5);
}

.column:hover::before {
    height: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

/* Enhanced Column Headers */
.column h3 {
    font-size: 1.8rem;
    font-weight: 800;
    margin-bottom: 30px;
    padding: 20px 0;
    border-bottom: 3px solid rgba(0, 0, 0, 0.05);
    color: #2d3748;
    text-shadow: none;
    position: relative;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 1px;
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

.column h3::before {
    content: '';
    margin-right: 0;
}

.column:nth-child(1) h3::before {
    content: '📋';
    margin-right: 10px;
}

.column:nth-child(2) h3::before {
    content: '⚡';
    margin-right: 10px;
}

.column:nth-child(3) h3::before {
    content: '✅';
    margin-right: 10px;
}

/* Enhanced Tasks */
.task {
    background: white;
    padding: 25px;
    margin-bottom: 20px;
    border-radius: 18px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: grab;
    box-shadow: 
        0 8px 25px rgba(0, 0, 0, 0.08),
        0 0 0 1px rgba(0, 0, 0, 0.05);
    border-left: 5px solid #e2e8f0;
    position: relative;
    overflow: hidden;
}

.task::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
    transform: scaleX(0);
    transition: transform 0.4s ease;
}

.task:hover::before {
    transform: scaleX(1);
}

.task:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow: 
        0 15px 40px rgba(0, 0, 0, 0.15),
        0 0 0 1px rgba(102, 126, 234, 0.1);
}

.task:active {
    cursor: grabbing;
    transform: rotate(3deg) scale(1.05);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
}

/* Priority-based task styling */
.task[style*="ffe5e5"] {
    border-left-color: #ff6b6b;
    background: linear-gradient(135deg, #fff5f5, #ffffff) !important;
    box-shadow: 0 8px 25px rgba(255, 107, 107, 0.15) !important;
}

.task[style*="e5fff1"] {
    border-left-color: #ffd93d;
    background: linear-gradient(135deg, #fffef5, #ffffff) !important;
    box-shadow: 0 8px 25px rgba(255, 217, 61, 0.15) !important;
}

.task[style*="#fff"] {
    border-left-color: #6bcf7f;
    background: linear-gradient(135deg, #f0fff4, #ffffff) !important;
    box-shadow: 0 8px 25px rgba(107, 207, 127, 0.15) !important;
}

/* Enhanced Task Content */
.task-title {
    font-weight: 800;
    font-size: 18px;
    margin-bottom: 12px;
    color: #2d3748;
    line-height: 1.3;
}

.task div:not(.task-title) {
    font-size: 14px;
    color: #718096;
    margin-bottom: 10px;
    line-height: 1.5;
    font-weight: 500;
}

.task div:last-child {
    margin-top: 20px;
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

/* Enhanced Task Buttons */
.task a,
.task button {
    padding: 10px 16px;
    font-size: 12px;
    font-weight: 700;
    border-radius: 10px;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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

/* Task Button Specific Colors */
.task a[style*="ffc107"] {
    background: linear-gradient(135deg, #ffeaa7, #fdcb6e) !important;
    color: white !important;
    box-shadow: 0 4px 12px rgba(255, 193, 7, 0.4) !important;
}

.task button[style*="dc3545"] {
    background: linear-gradient(135deg, #fd79a8, #e84393) !important;
    color: white !important;
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4) !important;
}

.task button[style*="007bff"] {
    background: linear-gradient(135deg, #74b9ff, #0984e3) !important;
    color: white !important;
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.4) !important;
}

.task button[style*="28a745"] {
    background: linear-gradient(135deg, #55efc4, #00b894) !important;
    color: white !important;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4) !important;
}

.task a:hover,
.task button:hover {
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
}

/* Drag and Drop Visual Feedback */
.column[ondragover]:hover {
    background: rgba(102, 126, 234, 0.05) !important;
    border: 3px dashed #667eea !important;
    transform: scale(1.02) !important;
}

/* Mobile Responsiveness */
@media (max-width: 1024px) {
    .board {
        flex-direction: column;
        gap: 25px;
    }
    
    .column {
        min-height: auto;
    }

    .dashboard-title {
        font-size: 3rem;
    }
}

@media (max-width: 768px) {
    body {
        padding: 15px;
    }

    .top-bar {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }

    .top-bar > div:last-child {
        justify-content: center;
        flex-wrap: wrap;
    }

    .dashboard-title {
        font-size: 2.5rem;
        letter-spacing: -1px;
    }

    form {
        padding: 25px;
    }

    .task div:last-child {
        flex-direction: column;
        gap: 8px;
    }

    .task a,
    .task button {
        width: 100%;
        justify-content: center;
    }

    .column {
        padding: 20px;
    }
}

@media (max-width: 480px) {
    .top-bar {
        padding: 15px;
    }

    .top-bar a,
    .top-bar form button {
        padding: 10px 15px;
        font-size: 12px;
        gap: 6px;
    }

    .user-profile:first-of-type {
        flex-direction: column;
        text-align: center;
        padding: 15px;
    }

    .dashboard-title {
        font-size: 2rem;
    }

    h3 {
        font-size: 1.5rem;
    }

    .task {
        padding: 20px 15px;
    }
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 10px;
}

::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 10px;
    border: 2px solid rgba(255, 255, 255, 0.1);
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #5a6fd8, #6a4190);
}

/* Enhanced SweetAlert2 styling */
.swal2-popup {
    border-radius: 25px !important;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25) !important;
    backdrop-filter: blur(20px) !important;
}

.swal2-confirm {
    background: linear-gradient(135deg, #667eea, #764ba2) !important;
    border-radius: 12px !important;
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4) !important;
}

.swal2-cancel {
    background: linear-gradient(135deg, #fa709a, #fee140) !important;
    border-radius: 12px !important;
    box-shadow: 0 8px 20px rgba(250, 112, 154, 0.4) !important;
}

/* Loading States */
@keyframes shimmer {
    0% { background-position: -200px 0; }
    100% { background-position: calc(200px + 100%) 0; }
}

.task.loading {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%) !important;
    background-size: 200px 100%;
    animation: shimmer 2s infinite;
}

/* Focus and Accessibility */
.task:focus,
.top-bar a:focus,
.top-bar button:focus,
form input:focus,
form select:focus,
form textarea:focus,
form button:focus {
    outline: 3px solid rgba(102, 126, 234, 0.6);
    outline-offset: 3px;
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    body {
        background: #000;
        color: #fff;
    }
    
    .column,
    form,
    .top-bar {
        background: #fff;
        color: #000;
        border: 3px solid #000;
    }
    
    .task {
        background: #fff;
        color: #000;
        border: 2px solid #000;
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    *,
    *::
    </style>
    
</head>
<body>
    <div class="user-profile" style="
    display: flex;
    align-items: center;
    gap: 12px;
    background: white;
    padding: 12px 20px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    max-width: 300px;
    margin-bottom: 25px;
">
    <div style="
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        font-weight: bold;
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        text-transform: uppercase;
    ">
        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
    </div>
    <div>
        <div style="font-weight: 600; font-size: 1rem;">
            {{ Auth::user()->name }}
        </div>
        <a href="{{ route('profile') }}" style="font-size: 0.85rem; color: #667eea; text-decoration: none;">
            Lihat Profil
        </a>
    </div>
</div>

<div class="top-bar" style="justify-content: space-between;">
    <!-- PROFIL DI KIRI -->
    <div class="user-profile" style="
        display: flex;
        align-items: center;
        gap: 10px;
    ">
        <div style="
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-weight: bold;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            text-transform: uppercase;
        ">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>
        <div style="font-weight: 500; font-size: 0.95rem; color: #2d3748;">
            {{ Auth::user()->name }}
        </div>
    </div>

    <!-- TOMBOL-TOMBOL DI KANAN -->
    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
        <a href="{{ route('calendar') }}" class="calendar-btn">📅 Kalender</a>
        <a href="{{ route('report') }}" class="report-btn">📊 Laporan</a>
        <a href="{{ route('focus') }}" class="focus-btn">🎯 Mode Fokus</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">🔓 Logout</button>
        </form>
    </div>
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

