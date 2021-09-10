<?php

namespace App\Console\Commands;

use App\Models\Contest;
use App\Models\ContestFilter;
use App\Models\Entity;
use App\Models\Order;
use App\Notifications\SubscriptionWarning3DaysBefore;
use App\Notifications\SubscriptionWarning7DaysAfter;
use App\Notifications\SubscriptionWarning7DaysBefore;
use App\Notifications\SubscriptionWarningToday;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendSubscriptionWarnings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:send_warning_email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $entities = Entity::where('status',Entity::STATUS_APPROVED)->whereHas('orders', function($q){
            $q->where('status', Order::STATUS_PAYED);
        })->get();
        foreach($entities as $entity){
            $orders = $entity->orders()->where('status', Order::STATUS_PAYED)->get();
            if(!empty($orders)){
                foreach ($orders as $order){
                    $item = $order->orderItems()->first();
                    $newSub = Order::where('status',Order::STATUS_WAITING_PAYMENT)->where('name','like','%'.$item->product->description.'%')->first();
                    if(Carbon::parse($item->end_date)->equalTo(Carbon::today()) && !empty($newSub)){
                        //send warning - subscriptions ends today
                        $entity->user->notify(new SubscriptionWarningToday($item));
                    }
                    if(Carbon::parse($item->end_date)->equalTo(Carbon::today()->addDays(3)) && !empty($newSub)){
                        //send warning - subscriptions ends in 3 days
                        $entity->user->notify(new SubscriptionWarning3DaysBefore($item));
                    }
                    if(Carbon::parse($item->end_date)->equalTo(Carbon::today()->addDays(7))){
                        //send warning - subscriptions ends in 7 days
                        if(Order::createNewSubscription($order,$item)){
                            $entity->user->notify(new SubscriptionWarning7DaysBefore($item));
                        }
                    }
                    if(Carbon::parse($item->end_date)->equalTo(Carbon::today()->subDays(7)) && !empty($newSub)){
                        //send warning - subscriptions ended 7 days ago
                        $contestsCount = Contest::where('created_at','>=',Carbon::today()->subDays(7))->count();
                        $entity->user->notify(new SubscriptionWarning7DaysAfter($item,$contestsCount));
                    }
                }
            }
        }
    }
}
