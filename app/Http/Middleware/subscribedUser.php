<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ContestController;
use App\Http\Controllers\OrderController;
use App\Models\Order;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class subscribedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       // dd(auth()->user()->orders()->where('status',Order::STATUS_PAYED)->count());
       if(!User::subscribed() && !empty(auth()->user()->orders()->where('status',Order::STATUS_PAYED)->count() != 0)) {
            flash()->error('<p>' . __('A sua subscrição expirou. Para renovar carregue ') . '<a href="'.route('orders.create').'">aqui</a></p>');
        }elseif(!User::subscribed() && auth()->user()->orders()->where('status',Order::STATUS_PAYED)->count() == 0){
           flash()->error('<p>' . __('Para ter acesso aos conteúdos da plataforma necessita de uma subscrição. Para subscrever carregue ') . '<a href="'.route('orders.create').'">aqui</a></p>');
       }
       /*else{
            return redirect()->action([OrderController::class, 'create']);
        }*/
        return $next($request);

    }
}
