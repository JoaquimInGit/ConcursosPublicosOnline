<?php

namespace App\Observers;

use App\Models\Entity;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param \App\Models\Order $order
     * @return void
     */
    public function created(Order $order)
    {
        //$order->generateMB(NULL,true);
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param \App\Models\Order $order
     * @return void
     */
    public function updated(Order $order)
    {
        if(auth()->user()->cannot('manageApp')) {
            $enddate = OrderItem::where('entity_id', $order->entity_id)
                ->where('status', 2)
                ->orderBy('end_date', 'desc')->first();
            //ddd($order);
            // $orderItem = OrderItem::where('order_id', $order->id)->first();
            //ddd($orderItem->product_id == 1);
            //se a data de fim de pagamento for anterior ao dia de hoje
            //ddd($enddate->end_date > Carbon::today());
            if ($enddate != null && $enddate->end_date > Carbon::today()) {
                // ddd($enddate->end_date > Carbon::today());
                if ($order->status == 2) {
                    $orderItem = OrderItem::where('order_id', $order->id)->first();
                    if ($orderItem->product_id == 1) {
                        $orderItem->update(['start_date' => $enddate->end_date, 'end_date' => $enddate->end_date->addMonth(), 'status' => 2]);
                    } elseif ($orderItem->product_id == 2) {
                        $orderItem->update(['start_date' => $enddate->end_date, 'end_date' => $enddate->end_date->addQuarters(2), 'status' => 2]);
                    } elseif ($orderItem->product_id == 3) {
                        $orderItem->update(['start_date' => $enddate->end_date, 'end_date' => $enddate->end_date->addYear(), 'status' => 2]);
                    }
                    \Debugbar::ERROR();
                }
            } else {
                //  ddd($enddate->end_date > Carbon::today());
                if ($order->status == 2) {

                    $orderItem = OrderItem::where('order_id', $order->id)->first();
                    //ddd(($order->status == 2).' '.$orderItem);
                    if ($orderItem->product_id == 1) {
                        $orderItem->update(['start_date' => Carbon::today(), 'end_date' => Carbon::today()->addMonth(), 'status' => 2]);
                        $entity = Entity::where('id', $order->entity_id)->first();
                        $entity->update(['status' => 1]);
                    } elseif ($orderItem->product_id == 2) {
                        $orderItem->update(['start_date' => Carbon::today(), 'end_date' => Carbon::today()->addQuarters(2), 'status' => 2]);
                        $entity = Entity::where('id', $order->entity_id)->first();
                        $entity->update(['status' => 1]);
                    } elseif ($orderItem->product_id == 3) {
                        $orderItem->update(['start_date' => Carbon::today(), 'end_date' => Carbon::today()->addYear(), 'status' => 2]);
                        $entity = Entity::where('id', $order->entity_id)->first();
                        $entity->update(['status' => 1]);
                    }
                }

            }
        }

    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param \App\Models\Order $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param \App\Models\Order $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param \App\Models\Order $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
