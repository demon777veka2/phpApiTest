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

Route::post('login', 'Api\Auth\LoginController@login');
Route::post('registrations', 'Api\Auth\RegistrationsController@registrations');

Route::group(['middleware' => ['auth.jwt']], function () {
  Route::get('user', 'Api\TaskTwo\TaskTwoController@user');
  Route::post('user', 'Api\TaskTwo\TaskTwoController@userPut');

  Route::get('department', 'Api\TaskTwo\TaskTwoController@department');

  // Route::group(['prefix' => 'workers'], function () {
  //   Route::get('query/{name}', 'Api\TaskTwo\TaskTwoController@workersSerchName');
  //   Route::get('department_id/{id}', 'Api\TaskTwo\TaskTwoController@workersSerchIdOtdel');
  //   Route::get('position_id/{id}', 'Api\TaskTwo\TaskTwoController@workersSerchIdPost');
  //   Route::get('{id}', 'Api\taskTwo\TaskTwo@workersSerchIdUser');
  // });

//  Route::get('workers/{id}', 'Api\taskTwo\TaskTwoController@workersSerchIdUser');
  Route::get('workers', 'Api\TaskTwo\TaskTwoController@workersAll');

});
