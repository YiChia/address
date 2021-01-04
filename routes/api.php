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


Route::get('teacher/{teacherId}', 'TeacherController@findOne');
Route::post('teacher/create', 'TeacherController@create');
Route::put('teacher/update', 'TeacherController@update');
Route::delete('teacher/{teacherId}', 'TeacherController@delete');

Route::get('student/{studentId}', 'StudentController@findOne');
Route::post('student/create', 'StudentController@create');
Route::put('student/update/{studentId}', 'StudentController@update');
Route::delete('student/{studentId}', 'StudentController@delete');

Route::get('lesson/{lessonId}', 'LessonController@findOne');
Route::get('lesson/{lessonId}/students', 'LessonController@getStudentList');
Route::post('lesson/create', 'LessonController@create');
Route::put('lesson/update/{lessonId}', 'LessonController@update');
Route::delete('lesson/{lessonId}', 'LessonController@delete');

Route::put('select/lesson/', 'LessonController@selectLesson');
Route::put('withdraw/lesson/', 'LessonController@withdraw');


Route::put('lesson/{lessonId}/teacher', 'LessonController@changeTeacher');
Route::put('set/teacherAssistant/{lessonId}', 'LessonController@setTeacherAssistant');
