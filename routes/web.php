<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PomodoroController;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use App\Models\User;


// ========== Redirect otomatis dari root ==========
Route::get('/', function () {
    return view('landing'); // arahkan ke halaman landing
})->name('landing');

Route::get('/landing', function () {
    return view('landing');
})->name('landing');


// ========== TAMU (BELUM LOGIN) ==========
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Login Google
// Login Google
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);


    // Callback dari Google
    Route::get('/auth/google/callback', function () {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate([
            'email' => $googleUser->getEmail(),
        ], [
            'name' => $googleUser->getName(),
            'password' => bcrypt(Str::random(16)),
        ]);

        Auth::login($user);
        return redirect('/dashboard');
    });
});

// ========== PENGGUNA YANG SUDAH LOGIN ==========
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');

    // Tugas
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::post('/tasks/{id}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus'); // <-- COCOK DENGAN JS
    Route::post('/tasks/{id}/update-deadline', [TaskController::class, 'updateDeadline'])->name('tasks.updateDeadline');
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

   // Route untuk drag & drop (AJAX)
Route::post('/tasks/{id}/updateStatus', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

// Route untuk tombol manual (form biasa)
Route::post('/tasks/{id}/updateStatusManual', [TaskController::class, 'updateStatusManual'])->name('tasks.updateStatusManual');

    // Laporan
    Route::get('/laporan', [ReportController::class, 'index'])->name('report');
    Route::get('/report/chart-data', [TaskController::class, 'chartData'])->name('report.chartData');

    // Kalender
    Route::get('/calendar', [TaskController::class, 'calendar'])->name('calendar');
    Route::get('/calendar', [TaskController::class, 'calendar'])->name('calendar');
Route::post('/calendar/store', [TaskController::class, 'storeFromCalendar'])->name('calendar.store');


    // Fokus / Pomodoro
    Route::get('/focus', function () {
        return view('focus');
    })->name('focus');

    Route::post('/pomodoro/selesai', [PomodoroController::class, 'store'])->name('pomodoro.store');

    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});
Route::post('/tasks/{id}/updateStatus', [TaskController::class, 'updateStatus']);
Route::post('/tasks', [TaskController::class, 'storeFromCalendar']);

Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::post('/tasks/{id}/updateStatus', [TaskController::class, 'updateStatus']);
Route::get('/laporan/chart-data', [TaskController::class, 'chartData'])->name('report.chartData');
use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    // Profil User
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
});
  // PROFIL
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');

       // Pengaturan (Ganti Password)
    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    Route::post('/settings/password', [UserController::class, 'updatePassword'])->name('settings.password');

    Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/update-photo', [UserController::class, 'updatePhoto'])->name('profile.updatePhoto');
    Route::post('/settings/password', [UserController::class, 'updatePassword'])->name('settings.password');
});
Route::post('/profile/photo', [UserController::class, 'updatePhoto'])->name('profile.updatePhoto');
Route::get('/profile', function () {
    return view('profile');
})->name('profile');
