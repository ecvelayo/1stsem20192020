<?php

namespace App\Http\Middleware;

use Auth;
use App\Employee;
use Closure;

class Eatery
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
        $emp = Employee::find(Auth::user()->user_id);

        if(Auth::user()->user_type != '1' || $emp->emp_type != '3') {
            return redirect('/')->with('error', 'You are automatically logout for accessing the eatery page.');
        }
        return $next($request);
    }
}