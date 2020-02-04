<?php

namespace App\Http\Controllers;

use App\Student;
use App\Http\Requests\StudentRequest;
use Validator;

class StudentController extends Controller
{

    protected $user;

    /**
        Display a listing of the students.
     */

    public function index()
    {
        $student = Student::all();
        if($student)
        {
            return response()->json([
                'success' => true,
                'message' => 'Display all students successfully',
                'students' => $student
            ],200);
        }else
        {
            return response()->json([
                'success' => false,
                'message' => 'No student records found',
                'students' => null
            ],404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
      Store a newly created student.
     */

    public function store(StudentRequest $request)
    {
        $validator = Validator::make($request->all);
        if($validator)
        {
            $student = new Student;
            if ($student->fill($request->all())->save()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Student added successfully',
                    'student' => $student
                ],201);
            } else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, student record could not be added'
                ], 500);
            }
        }
    }

    /**
        Display the specified student record.
     */

    public function show(Student $student)
    {
        if($student){
            return response()->json([
                'success' => true,
                'message' => 'Specified student record',
                'student' => $student
            ],200);
        }else
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, Student not found'
            ], 404);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
        Update specified student record
     */

    public function update(Student $student, StudentRequest $request)
    {
        $validator = Validator::make($request->all);
        if($validator) {
            if ($student->fill($request->all())->save()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Student updated successfully',
                    'student' => $student
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, student record could not be updated'
                ], 500);
            }
        }
    }


    /**
        Remove the specified student record.
        Json content will not be returned due to 204 http status code.
     */

    public function destroy(Student $student)
    {
        if($student->delete()){
            return response()->json([
                'success' => true,
                'message' => 'Student deleted successfully'
            ],204);
        }else
        {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, student record could not be deleted'
            ], 500);
        }

    }
}
