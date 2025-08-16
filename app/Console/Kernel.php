<?php

namespace App\Console;

use App\Console\Commands\CleanUnusedImages;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
        parent::commands();
        $this->commands([
            CleanUnusedImages::class,
        ]);
    }
}
