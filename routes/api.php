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


Route::post('/login', [App\Http\Controllers\API\Login::class, 'login']);

Route::middleware('auth:api')->group(function (){
    Route::get('patient-file/{id}', [App\Http\Controllers\API\PatientFileAPI::class , 'getPatFile']);
});

Route::get('slider', [App\Http\Controllers\API\SliderAPI::class , 'getSliderAPI']);
Route::get('news', [App\Http\Controllers\API\NewsAPI::class , 'getNewsAPI']);
Route::get('staff', [App\Http\Controllers\API\StaffAPI::class , 'getStaffAPI']);
