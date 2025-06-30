<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class ServeWithOpen extends Command
{
    protected $signature = 'serve:open';
    protected $description = 'Serve the application and open in browser automatically';

    public function handle()
    {
        $this->info('Menjalankan Laravel dan membuka browser...');

        // Jalankan Laravel server di background
        $process = new Process(['php', 'artisan', 'serve']);
        $process->start();

        // Tunggu sebentar supaya server jalan dulu
        sleep(2);

        // Ganti URL ini sesuai kebutuhan (login, dashboard, dsb)
        $url = 'http://127.0.0.1:8000';

        // Buka browser
        if (PHP_OS_FAMILY === 'Windows') {
            exec("start {$url}");
        } elseif (PHP_OS_FAMILY === 'Darwin') {
            exec("open {$url}"); // Mac
        } else {
            exec("xdg-open {$url}"); // Linux
        }

        // Biarkan proses artisan serve tetap hidup
        while ($process->isRunning()) {
            usleep(100000); // 100ms
        }

        return 0;
    }
}
