<?php

namespace App\Http\Middleware;

use App\Models\Doctor\Doctor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureDoctor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */    public function handle(Request $request, Closure $next)
    {



        $userEmail=Auth::guard('sanctum')->user()->email;
        $user=Doctor::where('email',$userEmail)->first();
        if ( $user) {
            return $next($request);
        }

        abort(401, 'Unauthorized');
    }
}
