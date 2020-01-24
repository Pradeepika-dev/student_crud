<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\StudentResource;
use App\Student;
use App\Http\Requests;
use JWTAuth;

class StudentController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::all();
        return StudentResource::collection($student);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'joined_year' => 'required|integer'
        ]);

        $student = new Student;
        $student->teacher_id = $request->input('teacher_id');
        $student->classroom_id = $request->input('classroom_id');
        $student->firstname = $request->input('firstname');
        $student->lastname = $request->input('lastname');
        $student->gender = $request->input('gender');
        $student->joined_year = $request->input('joined_year');

        if ($student->save())
            return response()->json([
                'success' => true,
                'student' => $student
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, student record could not be added'
            ], 500);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        if( $student ){
            return new StudentResource($student);
        }
        return "Student Not found"; // temporary error

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        $student->teacher_id = $request->input('teacher_id');
        $student->classroom_id = $request->input('classroom_id');
        $student->firstname = $request->input('firstname');
        $student->lastname = $request->input('lastname');
        $student->gender = $request->input('gender');
        $student->joined_year = $request->input('joined_year');
        $student->save();
        return new StudentResource($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrfail($id);
        if($student->delete()){
            return  new StudentResource($student);
        }
        return "Error while deleting";
    }
}
