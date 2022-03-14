<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;



class Statuses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $expirtesAt =  Carbon::now()->addMinute(1);
            Cache::put('มีเจ้าของ' . Auth::user()->id, true, $expirtesAt);
        }
        return $next($request);
    }
}
