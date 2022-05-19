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

// получить список студентов
Route::get('students', [
    'uses' => 'StudentsController@index'
]);


// получить студента по email
Route::get('students/email', [
    'uses' => 'StudentsController@showStudentByEmail',
    'middleware' => [ 'get_student_by_email' ],
]);


// получить студента по id
Route::get('students/{id}', [
    'uses' => 'StudentsController@showStudent'
]);


// редактировать студента по id
Route::put('students/{id}', [
    'uses' => 'StudentsController@editStudent',
    'middleware' => [ 'edit_student' ],
]);

Route::delete('students/{id}', [
    'uses' => 'StudentsController@deleteStudent'
]);


// создать нового студента 
Route::post(
    'students/create', 
    [ 
        'uses' => 'StudentsController@store', 
        'middleware' => [ 'add_new_student' ],
    ] 
);
