<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\UpdateResources::class,
        Commands\ClearResources::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        
        // 每小时更新漫画信息
        // $schedule->command('update-resources')->hourly();

        // 每天发送更新提醒邮件
        $schedule->command('update-resources')->dailyAt('00:30');

        // 每小时清理，减少更新数据量
        $schedule->command('clear-resources')->hourlyAt(1);

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function cmmands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
