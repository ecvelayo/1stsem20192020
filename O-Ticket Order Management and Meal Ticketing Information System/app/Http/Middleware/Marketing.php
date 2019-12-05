<?php

namespace App\Http\Middleware;

use Auth;
use App\Employee;
use Closure;

class Marketing
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

        if(Auth::user()->user_type != '1' || $emp->emp_type != '2') {
            return redirect('/')->with('error', 'You are automatically logout for accessing the marketing page.');
        }
        return $next($request);
    }
}
