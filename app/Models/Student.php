<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'admission_number','first_name', 'last_name', 'guardian_name', 'guardian_phone_number', 'guardian_email', 'class_id'];
}
