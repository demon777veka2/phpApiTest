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

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

Route::get('login', 'Api\Auth\LoginController@loginView');
Route::post('login', 'Api\Auth\LoginController@login');
Route::post('registrations', 'Api\Auth\RegistrationsController@registrations');



//Route::get('table', 'Api\taskTwo\taskTwoController@table');

//Route::group(['middleware'=> ['jwt.verify']], function(){
   
  //  Route::get('table/{id}', 'Api\taskTwo\taskTwoController@tableid');
    
 //   Route::post('table', 'Api\taskTwo\taskTwoController@tableSave');
    
 //   Route::put('table/{id}', 'Api\taskTwo\taskTwoController@tableEdit');
//    Route::delete('table/{id}', 'Api\taskTwo\taskTwoController@tableDelete');

//});
