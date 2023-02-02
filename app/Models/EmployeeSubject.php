<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSubject extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'employee_id', 'subject_id', 'class_id'];
}
