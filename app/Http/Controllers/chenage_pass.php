<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\code;

class chenage_pass extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {   
        $data = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $code=code::where('email',$request->input('email')) ->latest()->first();
        if($code=== null || $code->use==='no' || $code->is_change==='yes')
        {
            return response()->json([
                'errors'=>[
                    'code' => [
                        'Your code is invalid!']
                ]
            ], 401);
        }
        $user=User::where('email',$request->input('email')) -> firstOrFail();
        $user->password=Hash::make($request->input('password'));
        $user->save();
        $code->is_change='yes';
        $code->save();
    }
}
