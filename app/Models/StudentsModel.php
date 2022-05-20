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

    public function updateStudent( $request, $id ){

        $student = $this->find($id);

        $student->update( $request->all() );

        return $student;

    }

    public function emailIsExisting( $email ){

        $result = false;

        $student = $this->where('email', '=', $email )->first();

        if( isset($student) ){
            $result = true;
        };

        return $result;

    }

    public function deleteStudent( $id ){

        $student = $this->find($id);

        if( isset( $student ) ){
            $student->delete();
        };

        return $this->getListOfStudents();
        

    }

    public function emailIsUniqueForEdit( string $email, int $id ) : bool {
        /*
                Данный метод изначально был создан для применения его в правилах проверки при валидации в посреднике, 
            который предназначен для метода редактирования данных одного студента. 

                Если во время редактирования данных студента пользователь в качестве параметра email передаст значение 
            уже существующее в БД в записи относящейся к этому же студенту, то валидатор не пропустил бы данное значение email, 
            потому, что посчитал бы его не уникальным. То-есть студент с почтой a@mail.ru попытавшись переписать его на такое же 
            значение a@mail.ru не смог бы этого сделать. 
                Данный метод проверяет существуют ли другие студенты, кроме редактируемого, с email таким же как в 
            передаваемом параметре email. Если да, то возвращает false (проверка не пройдена) и true (если пройдена)
        */
        $result = true;

        $student = $this->where('email', '=', $email )->first();

        if( isset($student) ){
            if( $student->id === $id ){
                $result = true;
            }else{
                $result = false;
            };
        };

        return $result;

    }


















































}
