<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'App\Http\Controllers\loginController')
    ->name('login');
Route::post('register','App\Http\Controllers\registerController')->name('register');
Route::post('email','App\Http\Controllers\emailcontroller')->name('email');
Route::post('chek_email','App\Http\Controllers\chekemail')->name('chek_email');
Route::post('chenage_pass','App\Http\Controllers\chenage_pass')->name('chenage_pass');
Route::post('chek_code','App\Http\Controllers\chek_code')->name('chek_code');

