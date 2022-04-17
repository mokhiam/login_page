<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Carbon\Carbon;

class loginController extends Controller
{
    
    public function __invoke(Request $request)
    {    
      
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $email=$request->email;
            $user=User::where('email',$email)->first();
            $id=$user->id;
            $name= $user->name;
            $date = Carbon::now();
            $key = "example_key";
            $payload = array(
                "sub" => $email,
                "name" => $name,
                "iat" => $id,
                "time"=>$date
            );
            $jwt = JWT::encode($payload, $key, 'HS256');
            return $jwt;
        }
        return response()->json([
            'errors'=>[
                'email' => [
                    'The provided credentials do not match our records.']
            ]
        ], 401);
    }
}
