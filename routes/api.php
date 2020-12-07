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


Route::post('admin/login','Api\Auth\AdminLoginController@login');;
Route::post('teacher/login','Api\Auth\TeacherLoginController@login');
Route::post('user/login','Api\Auth\UserLoginController@login');



Route::group([

    'middleware' => ['auth'] ,
    'prefix' => 'admin'

], function ($router) {
    Route::get('demo', 'Api\Auth\AdminLoginController@demo');
    Route::get('logout', 'Api\Auth\AdminLoginController@logout');
    // Route::post('refresh', 'AdminController@refresh');

});

Route::group([

    'middleware' => ['auth'] ,
    'prefix' => 'teacher'

], function ($router) {
    Route::get('demo', 'Api\Auth\TeacherLoginController@demo');
    Route::get('logout', 'Api\Auth\TeacherLoginController@logout');
    // Route::post('refresh', 'AdminController@refresh');

});

Route::group([

    'middleware' => ['auth'] ,
    'prefix' => 'user'

], function ($router) {
    Route::get('demo', 'Api\Auth\UserLoginController@demo');
    Route::get('logout', 'Api\Auth\UserLoginController@logout');
    // Route::post('refresh', 'AdminController@refresh');

});