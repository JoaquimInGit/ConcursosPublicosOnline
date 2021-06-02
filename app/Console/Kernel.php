<?php

namespace App\Console;

use App\Console\Commands\AuthPermissionCommand;
use App\Helpers\ContestBusinessLogic;
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
        //AuthPermissionCommand::class, //não precisa já porque faz auto load
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        //corre o InsertContests a cada minuto
        //TODO:Mudar para o tempo que queremos
        /*$schedule->call(function(){
            ContestBusinessLogic::insertContests();
        })->everyTwoMinutes();
*/
       $schedule->call(function(){
            ContestBusinessLogic::insertContests();
        })->twiceDaily(8, 14);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
