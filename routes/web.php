<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

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

Route::group(['middleware' => ['AdminCheck']], function () {
    Route::get('users/', 'Api\TaskTwo\AdminPanelController@user');
    Route::get('user/{id}/delete', 'Api\TaskTwo\AdminPanelController@userDelete');
    Route::get('user/{id}/edit', 'Api\TaskTwo\AdminPanelController@userEditView');
    Route::post('user/{id}/edit', 'Api\TaskTwo\AdminPanelController@userEdit');
    Route::get('user/add', 'Api\TaskTwo\AdminPanelController@userAddView');
    Route::post('user/add', 'Api\TaskTwo\AdminPanelController@userAdd');

    Route::get('positions', 'Api\TaskTwo\AdminPanelController@post');
    Route::get('positions/{id}/delete', 'Api\TaskTwo\AdminPanelController@postDelete');
    Route::get('positions/{id}/edit', 'Api\TaskTwo\AdminPanelController@postEditView');
    Route::post('positions/{id}/edit', 'Api\TaskTwo\AdminPanelController@postEdit');
    Route::get('positions/add', 'Api\TaskTwo\AdminPanelController@postAddView');
    Route::post('positions/add', 'Api\TaskTwo\AdminPanelController@postAdd');

    Route::get('departments', 'Api\TaskTwo\AdminPanelController@otdel');
    Route::get('department/{id}/delete', 'Api\TaskTwo\AdminPanelController@otdelDelete');
    Route::get('department/{id}/edit', 'Api\TaskTwo\AdminPanelController@otdelEditView');
    Route::post('department/{id}/edit', 'Api\TaskTwo\AdminPanelController@otdelEdit');
    Route::get('department/add', 'Api\TaskTwo\AdminPanelController@otdelAddView');
    Route::post('department/add', 'Api\TaskTwo\AdminPanelController@otdelAdd');
});


Route::group(['prefix' => 'adminvgr'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');
