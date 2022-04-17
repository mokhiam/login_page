<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class chekemail extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable 
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {   
        $credentials = $request->validate([
        'email' => ['required', 'email'],
        ]);

        $user=User::where('email',$request->input('email')) -> first();

        if($user===null)
        {
            return response()->json([
                'errors'=>[
                    'email' => [
                        'Your email could not be found!']
                ]
            ], 404);
        }
        return $user;
    }
}
