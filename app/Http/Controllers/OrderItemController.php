<?php

namespace App\Http\Controllers;

use App\DataTables\OrderItemDataTable;
use Illuminate\Http\Request;
//use App\Http\Requests\CreateOrderItemRequest;
//use App\Http\Requests\UpdateOrderItemRequest;
use App\Models\OrderItem;
//use Flash;
//use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the OrderItem.
     *
     * @param OrderItemDataTable $orderItemDataTable
     * @return Response
     */
    public function index(OrderItemDataTable $orderItemDataTable)
    {
        return $orderItemDataTable->render('order_items.index');
    }

    /**
     * Show the form for creating a new OrderItem.
     *
     * @return Response
     */
    public function create()
    {
        $orderItem = new OrderItem();
        $orderItem->loadDefaultValues();
        return view('order_items.create', compact('orderItem'));
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

        if(($model = OrderItem::create($validatedAttributes)) ) {
            //flash(Order Item saved successfully.');
            //Flash::success('Order Item saved successfully.');
            return redirect(route('order-items.show', $model));
        }else
            return redirect()->back();
    }

    /**
     * Display the specified OrderItem.
     *
     * @param  OrderItem  $orderItem
     * @return Response
     */
    public function show(OrderItem $orderItem)
    {
        return view('order_items.show', compact('orderItem'));
    }

    /**
     * Show the form for editing the specified OrderItem.
     *
     * @param  OrderItem $orderItem
     * @return Response
     */
    public function edit(OrderItem $orderItem)
    {
        return view('order_items.edit', compact('orderItem'));
    }

    /**
     * Update the specified OrderItem in storage.
     *
     * @param  Request  $request
     * @param  OrderItem $orderItem
     * @return Response
     */
    public function update(Request $request, OrderItem $orderItem)
    {
        $validatedAttributes = $this->validateForm($request, $orderItem);
        $orderItem->fill($validatedAttributes);
        if($orderItem->save()) {
            //flash('Order Item updated successfully.');
            //Flash::success('Order Item updated successfully.');
            return redirect(route('order-items.show', $orderItem));
        }else{
            return redirect()->back();
        }
    }

     /**
      * Remove the specified OrderItem from storage.
      *
      * @param  \App\Models\OrderItem  $orderItem
      * @return Response
      */
    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();
        //Flash::success('Order Item deleted successfully.');

        return redirect(route('order-items.index'));
    }

    /**
     * @return array
     */
    public function validateForm(Request $request, OrderItem $model = null): array
    {

        $validate_array = OrderItem::$rules;

        return $request->validate($validate_array, [], OrderItem::attributeLabels());
    }
}
