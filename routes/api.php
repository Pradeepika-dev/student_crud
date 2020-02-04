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
Route::post('login', 'ApiController@login');


Route::group(['middleware' => 'jwt.verify'], function () {
    Route::get('logout', 'ApiController@logout');
    Route::get('user', 'ApiController@getAuthUser');
    Route::get('students', 'StudentController@index')->name('student.all');
    Route::get('student/{student}', 'StudentController@show')->name('student.show');

    Route::post('student', 'StudentController@store')->name('student.create');

    Route::put('student/{student}', 'StudentController@update')->name('student.update');
    Route::delete('student/{student}', 'StudentController@destroy')->name('student.delete');
});
