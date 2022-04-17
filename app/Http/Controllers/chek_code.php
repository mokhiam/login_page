<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\code;
use Carbon\Carbon;

class chek_code extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {   code::where('created_at', '<', Carbon::now()->subMinutes(5))->delete();
        $code=code::where('email',$request->input('email')) ->latest()->first();
        if($code=== null || $code->use==='yes' || $code->num!==(int)$request->input('code'))
        {
            return response()->json([
                'errors'=>[
                    'code' => [
                        'Your code is invalid!']
                ]
            ], 401);
        }
        $code->use='yes';
        $code->save();

    }
}
