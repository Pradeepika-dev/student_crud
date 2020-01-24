<?php

use Illuminate\Http\Request;

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

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');


Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');

    Route::get('user', 'ApiController@getAuthUser');

    Route::get('students', 'StudentController@index')->name('student.all');
    Route::get('student/{id}', 'StudentController@show')->name('student.show');
    Route::post('student', 'StudentController@store')->name('student.create');
    Route::put('student/{id}', 'StudentController@update')->name('student.update');
    Route::delete('student/{id}', 'StudentController@destroy')->name('student.delete');
});
