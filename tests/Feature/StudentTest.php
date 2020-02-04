<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Auth;
use App\Student;


class StudentTest extends TestCase
{
//    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // Create and authenticate users
    protected function authenticate(){
        $user = User::create([
            'name' => 'dus',
            'email' => 'dus1@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        $token = JWTAuth::fromUser($user);
        return $token;
    }


    public function testCreate()
    {
        $this->withoutExceptionHandling();
        // Get token
        $token = $this->authenticate();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST', route('student.create'),[
            'teacher_id' => 1,
            'classroom_id' => 1,
            'firstname' => 'Kumar',
            'lastname' => 'Dixit',
            'gender' => 'M',
            'joined_year' => '2019'
        ]);

        $response->assertStatus(201);
        User::where('email','dus1@gmail.com')->delete();
    }


    public function testAll(){

        $token = $this->authenticate();

        $student = Student::create([
            'teacher_id' => 2,
            'classroom_id' => 1,
            'firstname' => 'Loretta',
            'lastname' => 'Bedells',
            'gender' => 'M',
            'joined_year' => '2017'
        ]);
        $student->save();
        // Call routing and assert response
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET',route('student.all'));

        $response->assertStatus(200);
        User::where('email','dus1@gmail.com')->delete();
    }


    public function testUpdate(){
        $token = $this->authenticate();
        $student = Student::create([
            'teacher_id' => 1,
            'classroom_id' => 2,
            'firstname' => 'Juana',
            'lastname' => 'MacGall',
            'gender' => 'F',
            'joined_year' => '2018'
        ]);
        $student->save();
        // Call routing and assert response
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('PUT',route('student.update',['student' => $student]),[
            'teacher_id' => 1,
            'classroom_id' => 2,
            'firstname' => 'Juana1010',
            'lastname' => 'MacGall1010',
            'gender' => 'F',
            'joined_year' => '2019'
        ]);
        $response->assertStatus(200);
        User::where('email','dus1@gmail.com')->delete();
    }


    public function testShow(){
        $token = $this->authenticate();
        $student = Student::create([
            'teacher_id' => 1,
            'classroom_id' => 1,
            'firstname' => 'Levey',
            'lastname' => 'Brandsma',
            'gender' => 'M',
            'joined_year' => '2017'
        ]);
        $student->save();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET',route('student.show',['student' => $student->id]));
        $response->assertStatus(200);
        User::where('email','dus1@gmail.com')->delete();
    }


    public function testDelete(){
        $token = $this->authenticate();
        $student = Student::create([
            'teacher_id' => 2,
            'classroom_id' => 1,
            'firstname' => 'Shirley',
            'lastname' => 'Kettlewell',
            'gender' => 'F',
            'joined_year' => '2019'
        ]);
        $student->save();
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('DELETE',route('student.delete',['student' => $student->id]));
        $response->assertStatus(204);
        User::where('email','dus1@gmail.com')->delete();
    }

}
