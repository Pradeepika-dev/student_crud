<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = ['user_id','teacher_id', 'classroom_id', 'firstname','lastname','gender','joined_year'];


}
