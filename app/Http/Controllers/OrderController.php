<?php

namespace App\Http\Controllers;

use App\DataTables\OrderDataTable;
use App\Models\Entity;
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
            //ddd($request->submit);
            switch($request->submit) {
                case __('Monthly'):
                    break;
                case __('Semi-annual'):
                    $model->update(['sub_total'=>Order::getSpecificPrice(1),'iva_value'=>Order::getSpecificPriceIVA(1)]);
                    break;
                case __('Annual'):
                    $model->update(['sub_total'=>Order::getSpecificPrice(2),'iva_value'=>Order::getSpecificPriceIVA(2)]);
                    break;
            }
            //$model->syncCarts($validatedAttributes['Carts'],$validatedAttributes['client_id']);
            //if(isset($validatedAttributes['OrderItem']))
            //ddd($validatedAttributes['OrderItems']);
                //$model->syncOrderItem($validatedAttributes['OrderItems'],$validatedAttributes['entity_id']);
            return redirect(route('orders.show', $model));
        }else
            return redirect()->back();
    }


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
