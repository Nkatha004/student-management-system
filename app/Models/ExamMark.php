<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamMark extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'student_subject_id', 'term', 'year','mark', 'added_by'];
}
