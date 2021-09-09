<?php

namespace App\Http\Controllers;

use App\DataTables\OrderDataTable;
use App\DataTables\OrderItemDataTable;
use App\Facades\Eupago;
use App\Facades\Moloni;
use App\Facades\Setting;
use App\Models\Entity;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\FilterNotification;
use App\Notifications\OrderNotification;
use Carbon\Carbon;
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
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Order::class, 'order');
    }

    /**
     * Display a listing of the Order.
     *
     * @param OrderDataTable $orderDataTable
     * @return Response
     */
    public function index(OrderItemDataTable $orderDataTable)
    {
        $entity = !empty(auth()->user()) && !empty(auth()->user()->entity) ? auth()->user()->entity : null;
        return $orderDataTable->render('orders.index',compact('entity'));
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
        if(auth()->user()->can('accessAsUser') && !User::subscribed() && !empty(auth()->user()->orders()->where('status',Order::STATUS_PAYED)->get())){
            flash()->error( __('A sua subscrição expirou.'));
        }
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
            //ddd($model);
            $user = $model->getUser();
            switch($request->submit) {
                case __('Monthly'):
                    $model->update(['name'=> 'Subscrição Mensal','sub_total'=>Order::getSpecificPrice(0),'iva_value'=>Order::getSpecificPriceIVA(0)]);
                    $model->syncOrderItems($model,1);
                    $model->generateMB(NULL,true);
                    $user->notify(new OrderNotification($model));
                    break;
                case __('Semi-annual'):
                    $model->update(['name'=> 'Subscrição Semestral','sub_total'=>Order::getSpecificPrice(1),'iva_value'=>Order::getSpecificPriceIVA(1)]);
                    $model->syncOrderItems($model,2);
                    $model->generateMB(NULL,true);
                    $user->notify(new OrderNotification($model));
                    break;
                case __('Annual'):
                    $model->update(['name'=> 'Subscrição Annual','sub_total'=>Order::getSpecificPrice(2),'iva_value'=>Order::getSpecificPriceIVA(2)]);
                    $model->syncOrderItems($model,3);
                    $model->generateMB(NULL,true);
                    $user->notify(new OrderNotification($model));
                    break;
            }
            //$model->syncCarts($validatedAttributes['Carts'],$validatedAttributes['client_id']);
            //if(isset($validatedAttributes['OrderItem']))
            //ddd($validatedAttributes['OrderItems']);
            //ddd($model->id);
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
        dd('aqui');
        $validatedAttributes = $this->validateForm($request, $order);
        $order->fill($validatedAttributes);
        if($order->save()) {

            //flash('Order updated successfully.');
            //Flash::success('Order updated successfully.');
            if(auth()->user()->can('manageApp')){
                return redirect(route('orders.show', $order));
            }else{
                return redirect(route('orders.edit', $order));
            }
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
        $orderItem = OrderItem::where('order_id', $order->id)->first();
        $orderItem->delete();

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

    public function eupagoCallback(Request $request){
        $payment = new Payment();
        $payment->value = $request->get('valor', 0);
        $payment->setEupagoPaymentMethod($request->get('mp'));
        //ddd($payment);
        \Debugbar::error("Payment status".$payment->payment_method);
        $payment->transaction_id = $request->get('transacao');
        //ddd(Payment::STATUS_PAYMENT_COMPLETED);
        $payment->status = Payment::STATUS_PAYMENT_COMPLETED;
        $payment->raw_data = json_encode($request->toArray());
        $order = Order::find($request->get('identificador'));
        $orderCompleted = false;
        if($order == null){
            \Debugbar::error("Order with id:".$request->get('identificador')." not found");
            $payment->currency = "EUR";
            $payment->save();
            \Debugbar::error("Payment without order created with id ".$payment->id);
        }else {
            $payment->order_id = $order->id;
            $payment->currency = "EUR";
            \Debugbar::info($request->get('chave_api') ."==". config('eupago.key'));
            \Debugbar::info(floatval($order->iva_value) ."==". floatval($request->get('valor', 0)));
            \Debugbar::info($request->get('referencia') ."==". $order->mb_ref);
            if ($payment->payment_method == Payment::PAYMENT_METHOD_MB_REF) {
                if ($request->get('chave_api') == config('eupago.key') &&
                    floatval($order->iva_value) == floatval($request->get('valor', 0)) &&
                    $request->get('referencia') == $order->mb_ref) {
                    $orderCompleted = true;
                }
            } elseif ($payment->payment_method == Payment::PAYMENT_METHOD_MBWAY) {
                if ($request->get('chave_api') == config('eupago.key') &&
                    floatval($order->iva_value) == floatval($request->get('valor', 0)) &&
                    $request->get('referencia') == $order->mbway_ref) {
                    $orderCompleted = true;
                }
            }
            $payment->save();
            if($orderCompleted){
                //$payment->refresh();
                $order->status = Order::STATUS_PAYED;
            }else{
                $order->status = Order::STATUS_CANCELED;
            }
            $order->payment_method = $payment->payment_method;
            $order->save();
            if($order->status == Order::STATUS_PAYED){
                \Debugbar::info("Payment of order $order->id successful ");
                //send notification to admin
            }else{
                \Debugbar::error("Payment with ref ".$request->get('referencia')." as failed ");
                //send notification to admin
            }
        }
        return true;
        // /orders/eupago-callback?valor=10.00000
        //&canal=Multibanco+testes
        //&referencia=100153903
        //&transacao=10398551
        //&identificador=4
        //&mp=
        //&chave_api=demo-eca9-f025-dca2-5f4
        //&data=2020-08-06:11:58:26
        //&entidade=82307
        //&comissao=0.86
        //&local=demo
    }

    public function payWithMBWay(Request $request){
        \Debugbar::error($request->all());
        $order = Order::where('id',$request['order_id'])->first();
        if(!empty($order)){
            if(str_contains(substr($request['phone'],0,3),351)) {
                $phone =substr($request['phone'],2,9);
            }elseif(str_contains(substr($request['phone'],0,3),'+351')){
                $phone =substr($request['phone'],3,9);
            }else{
                $phone = $request['phone'];
            }
            $mbway = $order->generateMBWay($phone,'Pagamento Concursos');

            if($mbway){
                return ['success' => true, 'mbway' => $order->mbway_alias , 'total' => $order->total];
            }else{
                return ['success' => false];
            }

        }
    }

    /**
     * Generate a invoice for the given order.
     *
     * @param  Order  $order
     * @return Response
     */
    public function generateInvoice(Order $order)
    {
        //$this->authorize('createInvoice', Order::class);
        if(!Moloni::isTokenValid()){
            Moloni::login();
            \Debugbar::info("faz login");
        }
        if($order->invoice_status == Order::INVOICE_STATUS_WAITING_EMISSION){
            $order->createInvoice();
        }
        return redirect()->back();
    }
}
