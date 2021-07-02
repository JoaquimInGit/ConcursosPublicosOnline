<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        //$order->generateMB(NULL,true);
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        if ($order->status == 2){
            $orderItem = OrderItem::where('order_id',$order->id)->first();
            if($orderItem->product_id == 1){
                $orderItem->update(['start_date'=> Carbon::today(),'end_date' => Carbon::today()->addMonth(),'status' => 2]);
            }elseif ($orderItem->product_id == 2){
                $orderItem->update(['start_date'=> Carbon::today(),'end_date' => Carbon::today()->addQuarters(2),'status' => 2]);
            }elseif ($orderItem->product_id == 3){
                $orderItem->update(['start_date'=> Carbon::today(),'end_date' => Carbon::today()->addYear(),'status' => 2]);
            }
        }
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
