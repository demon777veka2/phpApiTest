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

Route::get('login', 'Api\Auth\LoginController@loginView');
Route::post('login', 'Api\Auth\LoginController@login');
Route::post('registrations', 'Api\Auth\RegistrationsController@registrations');

Route::group(['middleware' => ['auth.jwt']], function () {
  Route::get('user', 'Api\taskTwo\taskTwoController@user');
  Route::put('user', 'Api\taskTwo\taskTwoController@userPut');

  Route::get('department', 'Api\taskTwo\taskTwoController@department');

  Route::get('workers/query/{name}', 'Api\taskTwo\taskTwoController@workersSerchName');
  Route::get('workers/department_id/{id}', 'Api\taskTwo\taskTwoController@workersSerchIdOtdel');
  Route::get('workers/position_id/{id}', 'Api\taskTwo\taskTwoController@workersSerchIdPost');
  Route::get('workers/{id}', 'Api\taskTwo\taskTwoController@workersSerchIdUser');
});
