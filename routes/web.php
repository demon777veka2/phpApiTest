<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('admin', 'Api\Auth\LoginController@loginAdminView');
Route::post('loginAdmin', 'Api\Auth\LoginController@loginAdmin');

Route::group(['middleware' => ['AdminCheck']], function () {
    Route::get('UserTable', 'Api\TaskTwo\AdminPanelController@user');
    Route::get('UserTableDelete/{id}', 'Api\TaskTwo\AdminPanelController@userDelete');
    Route::get('UserTableEdit/{id}', 'Api\TaskTwo\AdminPanelController@userEditView');
    Route::post('UserTableEdit/{id}', 'Api\TaskTwo\AdminPanelController@userEdit');
    Route::get('UserTableAdd', 'Api\TaskTwo\AdminPanelController@userAddView');
    Route::post('UserTableAdd', 'Api\TaskTwo\AdminPanelController@userAdd');

    Route::get('PostTable', 'Api\TaskTwo\AdminPanelController@post');
    Route::get('PostTableDelete/{id}', 'Api\TaskTwo\AdminPanelController@postDelete');
    Route::get('PostTableEdit/{id}', 'Api\TaskTwo\AdminPanelController@postEditView');
    Route::post('PostTableEdit/{id}', 'Api\TaskTwo\AdminPanelController@postEdit');
    Route::get('PostTableAdd', 'Api\TaskTwo\AdminPanelController@postAddView');
    Route::post('PostTableAdd', 'Api\TaskTwo\AdminPanelController@postAdd');

    Route::get('OtdelTable', 'Api\TaskTwo\AdminPanelController@otdel');
    Route::get('OtdelTableDelete/{id}', 'Api\TaskTwo\AdminPanelController@otdelDelete');
    Route::get('OtdelTableEdit/{id}', 'Api\TaskTwo\AdminPanelController@otdelEditView');
    Route::post('OtdelTableEdit/{id}', 'Api\TaskTwo\AdminPanelController@otdelEdit');
    Route::get('OtdelTableAdd', 'Api\TaskTwo\AdminPanelController@otdelAddView');
    Route::post('OtdelTableAdd', 'Api\TaskTwo\AdminPanelController@otdelAdd');
});
