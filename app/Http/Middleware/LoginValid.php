<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Models\User;
use Exception;
use Carbon\Carbon;

class LoginValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   $key = "example_key";
        try{
            $decoded = JWT::decode($request->header('Authorization'), new Key($key, 'HS256'));
            $date=new Carbon($decoded->time);
            $now =Carbon::now();
            $diff = $date->diffInMinutes($now);
            if ($diff>59)
            {   
             return response()->json([
             ],401);
            }
            return $next($request);
        }
        catch(Exception $err){
            return response()->json([
            ],401);
        }
 
    }
}
