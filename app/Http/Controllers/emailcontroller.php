<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use App\Models\code;
use Carbon\Carbon;
class emailcontroller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function  __invoke(Request $request)
    {        $code_num=code::create([
                'num'=>random_int(1000,9999),
                'email'=>$request->input('email'),
                'use'=>'no',
                'is_change'=>'no'
                ]);  
            Mail::to($request->input('email'))->send(new OrderShipped($code_num->num));
    }
}
