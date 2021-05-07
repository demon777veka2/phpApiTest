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

    Route::get('users', 'Api\TaskTwo\AdminPanelController@user')->name('users');
    Route::group(['prefix' => 'user'], function () {
        Route::get('{id}/delete', 'Api\TaskTwo\AdminPanelController@userDelete');
        Route::get('{id}/edit', 'Api\TaskTwo\AdminPanelController@userEditView');
        Route::post('{id}/edit', 'Api\TaskTwo\AdminPanelController@userEdit');
        Route::get('add', 'Api\TaskTwo\AdminPanelController@userAddView');
        Route::post('add', 'Api\TaskTwo\AdminPanelController@userAdd');
    });

    Route::get('positions', 'Api\TaskTwo\PositionController@post')->name('positions');
    Route::group(['prefix' => 'post'], function () {
        Route::get('{id}/delete', 'Api\TaskTwo\PositionController@postDelete');
        Route::get('{id}/edit', 'Api\TaskTwo\PositionController@postEditView');
        Route::post('{id}/edit', 'Api\TaskTwo\PositionController@postEdit');
        Route::get('add', 'Api\TaskTwo\PositionController@postAddView');
        Route::post('add', 'Api\TaskTwo\PositionController@postAdd');
    });

    Route::get('departments', 'Api\TaskTwo\DepartmenController@department')->name('departments');
    Route::group(['prefix' => 'department'], function () {
        Route::get('{id}/delete', 'Api\TaskTwo\DepartmenController@departmentDelete');
        Route::get('{id}/edit', 'Api\TaskTwo\DepartmenController@departmentEditView');
        Route::post('{id}/edit', 'Api\TaskTwo\DepartmenController@departmentEdit');
        Route::get('add', 'Api\TaskTwo\DepartmenController@departmentAddView');
        Route::post('add', 'Api\TaskTwo\DepartmenController@departmentAdd');
    });
});


Route::group(['prefix' => 'adminvgr'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');
