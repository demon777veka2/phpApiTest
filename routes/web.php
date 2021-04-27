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
Route::post('admin', 'Api\Auth\LoginController@loginAdmin');

Route::group(['middleware' => ['AdminCheck']], function () {
    Route::get('user-table', 'Api\TaskTwo\AdminPanelController@user');
    Route::get('user-table-delete/{id}', 'Api\TaskTwo\AdminPanelController@userDelete');
    Route::get('user-table-edit/{id}', 'Api\TaskTwo\AdminPanelController@userEditView');
    Route::post('user-table-edit/{id}', 'Api\TaskTwo\AdminPanelController@userEdit');
    Route::get('user-table-add', 'Api\TaskTwo\AdminPanelController@userAddView');
    Route::post('user-table-add', 'Api\TaskTwo\AdminPanelController@userAdd');

    Route::get('post-table', 'Api\TaskTwo\AdminPanelController@post');
    Route::get('post-table-delete/{id}', 'Api\TaskTwo\AdminPanelController@postDelete');
    Route::get('post-table-edit/{id}', 'Api\TaskTwo\AdminPanelController@postEditView');
    Route::post('post-table-edit/{id}', 'Api\TaskTwo\AdminPanelController@postEdit');
    Route::get('post-table-add', 'Api\TaskTwo\AdminPanelController@postAddView');
    Route::post('post-table-add', 'Api\TaskTwo\AdminPanelController@postAdd');

    Route::get('otdel-table', 'Api\TaskTwo\AdminPanelController@otdel');
    Route::get('otdel-table-delete/{id}', 'Api\TaskTwo\AdminPanelController@otdelDelete');
    Route::get('otdel-table-edit/{id}', 'Api\TaskTwo\AdminPanelController@otdelEditView');
    Route::post('otdel-table-edit/{id}', 'Api\TaskTwo\AdminPanelController@otdelEdit');
    Route::get('otdel-table-add', 'Api\TaskTwo\AdminPanelController@otdelAddView');
    Route::post('otdel-table-add', 'Api\TaskTwo\AdminPanelController@otdelAdd');
});


Route::group(['prefix' => 'adminvgr'], function () {
    Voyager::routes();
});
