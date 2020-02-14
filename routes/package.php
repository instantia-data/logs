<?php

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
Route::group(['prefix' => 'backend', 'middleware' => ['web', 'auth', 'has_backend']], function () {

    Route::group(['prefix' => 'logs', 'middleware' => 'policy:logs'], function () {
        Route::get('/', 'LogsController@index')->name('admin.logs')->middleware('checkact:access');
        Route::get('/create', 'LogsController@create')->name('logs.create')->middleware('checkact:create');
        Route::get('/edit/{id}', 'LogsController@edit')->name('logs.edit')->middleware('checkact:access');
        Route::get('/destroy/{id}', 'LogsController@destroy')->name('logs.destroy')->middleware('checkact:delete');
    });
});



Route::group(['middleware' => 'token:api'], function () {

    Route::group(['prefix' => 'backend'], function () {

        Route::group(['prefix' => 'logs', 'middleware' => 'policy:logs'], function () {
            Route::post('/store', 'LogsController@store')->name('logs.store')->middleware('checkact:create');
            Route::post('/update/{id}', 'LogsController@update')->name('logs.update')->middleware('checkact:edit');
        });
        
    });
});


