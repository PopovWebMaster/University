<?php

declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StudentsModel extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'email', 
        'name', 
        'class_name',
    ];
    public $timestamps = true;

    // Добавляет нового студента
    public function addNewStudent( Request $request ){

        $student = $this;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->class_name = $request->class_name;
        $student->save();

        return $student;

    }

    public function getListOfStudents(){
        return $this->get();
    }

    public function getStudent( $id ){
        $student = $this->find($id);
        if( !isset($student) ){
            return [
                'error' => true,
                'message' => [ "the student with id {$id} does not exist" ],
            ];
        };
        
        return $student;
    }


    public function getAStudentByEmail( $email ){

        $student = $this->where('email', '=', $email )->first();

        if( !isset($student) ){
            return [
                'error' => true,
                'message' => [ "the student with email {$email} does not exist" ],
            ];
        };

        return $student;

    }













































}
