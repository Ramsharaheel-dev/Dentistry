<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands  = [
        Commands\AssistDelete::class,
        Commands\StudentNotesDelete::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('records:delete')->dailyAt('00:00');
        $schedule->command('notes:delete')->dailyAt('00:00');
    }


    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
