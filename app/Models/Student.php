<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Student extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable; 

    protected $fillable = ['id', 'admission_number','first_name', 'last_name', 'guardian_name', 'guardian_phone_number', 'guardian_email', 'class_id'];
}
