<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeSubject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'employee_id', 'subject_id', 'class_id'];
}
