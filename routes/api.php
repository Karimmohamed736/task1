<?php

use App\Http\Controllers\Usercontroller;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>['api','checkpassword'], 'namespace'=>'Api'],function(){
Route::post('login', [Usercontroller::class,'login']);
Route::post('country', [Usercontroller::class,'ByCountry']);
Route::post('age', [Usercontroller::class,'age']);

});