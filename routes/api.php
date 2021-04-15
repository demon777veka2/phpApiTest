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


Route::get('UserTable', 'Api\TaskTwo\AdminPanelController@user');
Route::get('UserTableDelete/{id}', 'Api\TaskTwo\AdminPanelController@userDelete');
Route::get('UserTableEdit/{id}', 'Api\TaskTwo\AdminPanelController@userEditView');
Route::post('UserTableEdit/{id}', 'Api\TaskTwo\AdminPanelController@userEdit');
Route::get('UserTableAdd', 'Api\TaskTwo\AdminPanelController@userAddView');
Route::post('UserTableAdd', 'Api\TaskTwo\AdminPanelController@userAdd');

Route::get('OtdelTable', 'Api\TaskTwo\AdminPanelController@otdel');
Route::get('OtdelTableDelete/{id}', 'Api\TaskTwo\AdminPanelController@otdelDelete');
Route::get('OtdelTableEdit/{id}', 'Api\TaskTwo\AdminPanelController@otdelEditView');
Route::post('OtdelTableEdit/{id}', 'Api\TaskTwo\AdminPanelController@otdelEdit');
Route::get('OtdelTableAdd', 'Api\TaskTwo\AdminPanelController@otdelAddView');
Route::post('OtdelTableAdd', 'Api\TaskTwo\AdminPanelController@otdelAdd');

Route::get('PostTable', 'Api\TaskTwo\AdminPanelController@post');
Route::get('PostTableDelete/{id}', 'Api\TaskTwo\AdminPanelController@postDelete');
Route::get('PostTableEdit/{id}', 'Api\TaskTwo\AdminPanelController@postEditView');
Route::post('PostTableEdit/{id}', 'Api\TaskTwo\AdminPanelController@postEdit');
Route::get('PostTableAdd', 'Api\TaskTwo\AdminPanelController@postAddView');
Route::post('PostTableAdd', 'Api\TaskTwo\AdminPanelController@postAdd');




Route::post('registrations', 'Api\Auth\RegistrationsController@registrations');

  Route::post('login', 'Api\Auth\LoginController@login');
  Route::get('admin', 'Api\Auth\LoginController@loginAdminView');



Route::group(['middleware' => ['auth.jwt']], function () {
  Route::get('user', 'Api\TaskTwo\TaskTwoController@user');
  Route::post('user', 'Api\TaskTwo\TaskTwoController@userPut');

  Route::get('department', 'Api\TaskTwo\TaskTwoController@department');

  Route::get('workers/query/{name}', 'Api\TaskTwo\TaskTwoController@workersSerchName');
  Route::get('workers/department_id/{id}', 'Api\TaskTwo\TaskTwoController@workersSerchIdOtdel');
  Route::get('workers/position_id/{id}', 'Api\TaskTwo\TaskTwoController@workersSerchIdPost');
  Route::get('workers/{id}', 'Api\taskTwo\TaskTwo@workersSerchIdUser');
});
