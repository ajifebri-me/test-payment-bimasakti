<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $date = Carbon::now()->format("Ymd");
        $key = $request->header("Sec-Token");

        if($date == $key){
            return $next($request);
        }

        return response()->json([
            'error' => 'Invalid Sec-Token'
        ], 401);
    }
}
