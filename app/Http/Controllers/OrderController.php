<?php

namespace App\Http\Controllers;

use App\DataTables\OrderDataTable;
use Illuminate\Http\Request;
//use App\Http\Requests\CreateOrderRequest;
//use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
//use Flash;
//use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the Order.
     *
     * @param OrderDataTable $orderDataTable
     * @return Response
     */
    public function index(OrderDataTable $orderDataTable)
    {
        return $orderDataTable->render('orders.index');
    }

    /**
     * Show the form for creating a new Order.
     *
     * @return Response
     */
    public function create()
    {
        $order = new Order();
        $order->loadDefaultValues();
        return view('orders.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedAttributes = $this->validateForm($request);

        if(($model = Order::create($validatedAttributes)) ) {
            //flash(Order saved successfully.');
            //Flash::success('Order saved successfully.');
            //$model->syncCarts($validatedAttributes['Carts'],$validatedAttributes['client_id']);
            //if(isset($validatedAttributes['Carts']))
                //$model->syncCarts($validatedAttributes['OrderItems'],$validatedAttributes['entity_id']);
            return redirect(route('orders.show', $model));
        }else
            return redirect()->back();
    }

    /*public function syncCarts($carts,$client_id){
        $cartsIds = $this->carts->pluck('id')->toArray();
        $updatedCartsIds = [];
        if(str_contains($this->order_reference,'Plano') && $this->status == Order::STATUS_PAYED){
            \Debugbar::error('plan payed');
            $status = Cart::STATUS_PAYED_PLAN;
        }elseif(str_contains($this->order_reference,'Plano') && $this->status == Order::STATUS_WAITING_PAYMENT){
            \Debugbar::error('plan waiting');
            $status = Cart::STATUS_WAITING_PAYMENT_PLAN;
        }elseif(str_contains($this->order_reference,'Sessão') && $this->status == Order::STATUS_WAITING_PAYMENT){
            \Debugbar::error('session waiting');
            $status = Cart::STATUS_WAITING_PAYMENT_SEPARATE;
        }elseif(str_contains($this->order_reference,'Sessão') && $this->status == Order::STATUS_PAYED){
            \Debugbar::error('session payed');
            $status = Cart::STATUS_PAYED_SEPARATE;
        }
        \Debugbar::error($status);
        if(!empty($status)){
            foreach($carts as $cart){
                if(empty($cart['id'])) {
                    $cart['price'] = round($cart['price'],2);
                    $cart['quantity'] = 1;
                    //$cart['start_at'] = Carbon::today();
                    //$cart['end_at'] = Carbon::today()->addYear();
                    $cart['status'] = $status;
                    $cart['client_id'] = $client_id;
                    $this->carts()->create($cart);
                }
                if(in_array($cart['id'], $cartsIds)){
                    $item = $this->carts->where('id', $cart['id'])->first();
                    $item->fill($cart);
                    $item->price = round($item->price , 2);
                    //$item->start_at = Carbon::today();
                    //$item->end_at = Carbon::today()->addYear();
                    $item->status = $status;
                    $item->client_id = $client_id;
                    $item->quantity = 1;
                    if (!empty(Client::where('id', $client_id)->first()) && !empty(Client::where('id', $client_id)->first()->clientPlanPrice()->where('status', ClientPlanPrice::STATUS_ACTIVE)->get()->last())) {
                        $item->client_plan_price_id = Client::where('id', $client_id)->first()->clientPlanPrice()->where('status', ClientPlanPrice::STATUS_ACTIVE)->get()->last()->id;
                    }
                    $item->save();
                    $updatedCartsIds[] = $cart['id'];
                }
            }
            $differenceArray = array_diff($cartsIds, $updatedCartsIds);
            foreach($differenceArray as $removeId){
                $this->carts()->where('id', $removeId)->delete();
            }
        }
    }*/
    /**
     * Display the specified Order.
     *
     * @param  Order  $order
     * @return Response
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param  Order $order
     * @return Response
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified Order in storage.
     *
     * @param  Request  $request
     * @param  Order $order
     * @return Response
     */
    public function update(Request $request, Order $order)
    {
        $validatedAttributes = $this->validateForm($request, $order);
        $order->fill($validatedAttributes);
        if($order->save()) {
            //flash('Order updated successfully.');
            //Flash::success('Order updated successfully.');
            return redirect(route('orders.show', $order));
        }else{
            return redirect()->back();
        }
    }

     /**
      * Remove the specified Order from storage.
      *
      * @param  \App\Models\Order  $order
      * @return Response
      */
    public function destroy(Order $order)
    {
        $order->delete();
        //Flash::success('Order deleted successfully.');

        return redirect(route('orders.index'));
    }

    /**
     * @return array
     */
    public function validateForm(Request $request, Order $model = null): array
    {

        $validate_array = Order::$rules;

        return $request->validate($validate_array, [], Order::attributeLabels());
    }
}
