<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'skills',
        'interests',
        'gpa',
        'education',
        'experience',
        'projects',
        'created_at',
    ];
}
