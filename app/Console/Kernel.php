<?php

namespace App\Console;

use App\Console\Commands\AuthPermissionCommand;
use App\Helpers\ContestBusinessLogic;
use App\Helpers\FiltersLogic;
use App\Models\Entity;
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

        $schedule->call(function () {
            ContestBusinessLogic::insertContests();
        })->hourly()->onSuccess(
            function () {
                FiltersLogic::applyFilter2();
            }
        );

        $schedule->call(function () {
            FiltersLogic::sendNotifications2();
        })->twiceDaily(7 , 13);


        // $schedule->command('inspire')->hourly();
        //corre o InsertContests a cada minuto
        /*$schedule->call(function(){
            ContestBusinessLogic::insertContests();
        })->everyFiveMinutes()->onSuccess(function () {
            FiltersLogic::applyFilter();
        })->onSuccess(function () {
            FiltersLogic::sendNotifications();
        });*/

        $schedule->call(function (){
            $entities = Entity::where('status', 1)->get();
            foreach ($entities as $entity) {
                if( !Entity::isEntitySubscribed($entity)){
                    $entity->update(['status' => 0]);
                }
            }
        })->daily();

/*
   $schedule->call(function (){
          FiltersLogic::applyFilter();
      })->twiceDaily(9, 15);
        $schedule->call(function (){
             FiltersLogic::sendNotifications();
         })->twiceDaily(9, 14);
  */
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
