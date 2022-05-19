<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\StudentsModel;

use Route;

class StudentsController extends Controller
{

    public function index( Request $request, StudentsModel $student){
       $result = $student->getListOfStudents();
       return response()->json( $result, 200 );
    }


    public function store( Request $request, StudentsModel $student ){
        $studentInfo = $student->addNewStudent( $request );
        return response()->json( $studentInfo, 201 );
    }

    public function showStudent( Request $request, $id, StudentsModel $student ){
        $studentInfo = $student->getStudent($id);
        return response()->json( $studentInfo, 201 );
    }


    public function showStudentByEmail( Request $request, StudentsModel $student ){
        $studentInfo = $student->getAStudentByEmail( $request->email );
        return response()->json( $studentInfo, 201 );

    }

    public function editStudent( Request $request, $id, StudentsModel $student ){
        $studentInfo = $student->updateStudent( $request, $id );
        return response()->json( $studentInfo, 201 );

    }

    public function deleteStudent( Request $request, $id, StudentsModel $student ){
        $studentInfo = $student->deleteStudent( $id );
        return response()->json( $studentInfo, 201 );

    }









}
