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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('course','CourseController');
Route::get('/exam/index','ExamController@index');
Route::post('/exam/create', 'ExamController@create');
Route::post('/exam/store', 'ExamController@store');
Route::post('/exam/delete', 'ExamController@delete');
Route::get('exam/ca', 'ExamController@showCA');
Route::get('exam/mark', 'ExamController@showExam');
Route::post('exam/upload', 'ExamController@uploadCA');
Route::post('exam/upload/exam', 'ExamController@uploadExam');
Route::post('exam/merge', 'ExamController@downloadResults');
Route::get('student/add', 'StudentController@addStudent');
Route::get('option/add', 'OptionController@addOption');
Route::get('lecturer/add', 'LecturerController@addLecturer');
Route::get('user/add', 'UserController@addUser');
Route::get('get/result', 'CourseController@courseResult');
Route::post('view/result', 'CourseController@showResult');