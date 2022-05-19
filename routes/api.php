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
    'uses' => 'StudentsController@showStudentByEmail'
]);


// получить студента по id
Route::get('students/{id?}', [
    'uses' => 'StudentsController@showStudent'
]);




// создать нового студента 
Route::post(
    'students/create', 
    [ 
        'uses' => 'StudentsController@store', 
        'middleware' => [ 'add_new_student' ],
    ] 
);
