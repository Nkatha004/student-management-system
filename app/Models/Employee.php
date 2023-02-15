<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'first_name', 'last_name', 'email', 'tsc_number', 'telephone_number','password', 'school_id', 'role_id'];
}
