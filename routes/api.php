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
//Login
Route::post('admin/login','Api\Auth\AdminLoginController@login');;
Route::post('teacher/login','Api\Auth\TeacherLoginController@login');
Route::post('user/login','Api\Auth\UserLoginController@login');

//Admin
Route::group([

    'middleware' => ['auth:admin'] ,
    'prefix' => 'admin'

], function ($router) {
    Route::get('demo', 'Api\Auth\AdminLoginController@demo');

    //Admin Details
    Route::get('logout', 'Api\Auth\AdminLoginController@logout');
    Route::get('getAdmin/{id}', 'Api\ApiControllers\AdminDetailsController@getOne');
    Route::put('/updateAdmin/{id}', 'Api\ApiControllers\AdminDetailsController@update');

    //Student Management
    Route::post('/addStudent', 'Api\ApiControllers\UserDetailController@store');
    Route::delete('/deleteStudent/{id}', 'Api\ApiControllers\UserDetailController@destroy');
    Route::get('studentList', 'Api\ApiControllers\UserDetailController@index');
    Route::get('getStudentsByClass/{id}', 'Api\ApiControllers\UserDetailController@getStudentsByClass');
    
    Route::get('/importStudent', 'Api\ApiControllers\UserDetailController@importStudent');
    Route::get('/exportStudent', 'Api\ApiControllers\UserDetailController@exportStudent');
    
    //Teacher Management
    Route::post('/addTeacher', 'Api\ApiControllers\TeacherDetailController@store');
    Route::delete('/deleteTeacher/{id}', 'Api\ApiControllers\TeacherDetailController@deleteTeacher');
    
    //Subjects
    Route::post('/addSubject', 'Api\ApiControllers\TeacherDetailController@storeSubject');
    Route::delete('/deleteSubject/{id}', 'Api\ApiControllers\TeacherDetailController@deleteSubj');

    //classTeacher
    Route::post('/addClassTeacher', 'Api\ApiControllers\TeacherDetailController@storeClassTeacher');
    Route::get('/getClassTeacher', 'Api\ApiControllers\TeacherDetailController@getClassTeacher');
    Route::delete('/deleteClassTeacher/{id}', 'Api\ApiControllers\TeacherDetailController@deleteClassTeacher');


    //Event management
    Route::post('addEvent', 'Api\ApiControllers\SchoolEventController@store');
    Route::put('updateEvent/{id}', 'Api\ApiControllers\SchoolEventController@update');
    Route::delete('deleteEvent/{id}', 'Api\ApiControllers\SchoolEventController@destroy');

    
   
});

Route::group([

    'middleware' => ['auth:teacher'] ,
    'prefix' => 'teacher'

], function ($router) {
    Route::get('demo', 'Api\Auth\TeacherLoginController@demo');
    Route::get('logout', 'Api\Auth\TeacherLoginController@logout');
    // Route::post('/addReport', 'Api\ApiControllers\ReportController@addReport');
    Route::delete('/deleteReport/{id}', 'Api\ApiControllers\ReportController@deleteReport');

});

Route::group([

    'middleware' => ['auth:user,admin'] ,
    'prefix' => 'user'

], function ($router) {
    Route::get('demo', 'Api\Auth\UserLoginController@demo');
    Route::get('logout', 'Api\Auth\UserLoginController@logout');
    Route::put('/updateStudent/{id}', 'Api\ApiControllers\UserDetailController@update');
    Route::get('/getStudent/{id}', 'Api\ApiControllers\UserDetailController@getOne');


});

Route::group([
    'middleware' => 'auth:admin,teacher' ,
], function ($router) {
    // Route::get('studentList', 'Api\ApiControllers\UserDetailController@index');
    Route::get('teacherList', 'Api\ApiControllers\TeacherDetailController@index');
    Route::put('/updateTeacher/{id}', 'Api\ApiControllers\TeacherDetailController@updateTeacher');
    Route::get('/getTeacher/{id}', 'Api\ApiControllers\TeacherDetailController@getOne');
    Route::get('/getSubjects', 'Api\ApiControllers\TeacherDetailController@allSubj');



});

Route::group([
    'middleware' => 'auth:admin,teacher,user' ,
], function ($router) {

    Route::get('interactors', 'Api\ApiControllers\EventInteractorsController@index');

});
Route::post('/addReport', 'Api\ApiControllers\ReportController@addReport');
Route::get('/getLatestReport/{id}', 'Api\ApiControllers\ReportController@getLatestReport');
Route::get('/getReport/{id}', 'Api\ApiControllers\ReportController@getReport');
Route::get('/getReports/{id}', 'Api\ApiControllers\ReportController@getReports');


// Route::get('/getLatestReport/{id}', 'Api\ApiControllers\ReportController@getLatestReport');
Route::get('/getReportAll', 'Api\ApiControllers\ReportController@getReportAll');

Route::put('/updateReport/{id}', 'Api\ApiControllers\ReportController@update');


Route::get('/getTeacherStudent/{id}', 'Api\ApiControllers\ReportController@getTeacherStudent');

Route::get('/getLatestReports/{id}', 'Api\ApiControllers\ReportController@getLatestReports');

Route::get('/getPastReports/{id}', 'Api\ApiControllers\ReportController@getPastReports');

//events
Route::get('getEvent/{id}', 'Api\ApiControllers\SchoolEventController@getOne');
Route::get('getEvents', 'Api\ApiControllers\SchoolEventController@index');
Route::get('getPast', 'Api\ApiControllers\SchoolEventController@getPast');
Route::get('getRecent', 'Api\ApiControllers\SchoolEventController@getRecent');
Route::get('getOngoing', 'Api\ApiControllers\SchoolEventController@getOngoing');
Route::get('getUpcoming', 'Api\ApiControllers\SchoolEventController@getUpcoming');
Route::get('ongoingFuture', 'Api\ApiControllers\SchoolEventController@ongoingFuture');


Route::get('/getHome', 'Api\ApiControllers\AdminDetailsController@home');



