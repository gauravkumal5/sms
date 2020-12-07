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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('admin/login','Api\Auth\AdminController@login');
Route::post('teacher/login','Api\Auth\TeacherController@login');
Route::post('user/login','Api\Auth\UserController@login');



Route::group([

    'middleware' => 'jwt.auth' ,
    'prefix' => 'admin'

], function ($router) {
    Route::get('demo', 'Api\Auth\AdminController@demo');
    Route::get('logout', 'Api\Auth\AdminController@logout');
    // Route::post('refresh', 'AdminController@refresh');

});

Route::group([

    'middleware' => 'jwt.auth' ,
    'prefix' => 'teacher'

], function ($router) {
    Route::get('demo', 'Api\Auth\TeacherController@demo');
    Route::get('logout', 'Api\Auth\TeacherController@logout');
    // Route::post('refresh', 'AdminController@refresh');

});

Route::group([

    'middleware' => 'jwt.auth' ,
    'prefix' => 'user'

], function ($router) {
    Route::get('demo', 'Api\Auth\TeacherController@demo');
    Route::get('logout', 'Api\Auth\TeacherController@logout');
    // Route::post('refresh', 'AdminController@refresh');

});