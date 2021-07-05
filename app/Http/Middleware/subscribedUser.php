<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ContestController;
use App\Http\Controllers\OrderController;
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
       if(User::subscribed()) {
            return $next($request);
        }else{
            return redirect()->action([OrderController::class, 'create']);
        }


    }
}
