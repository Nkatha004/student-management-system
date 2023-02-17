<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, softDeletes;
    
    protected $fillable = ['id', 'role_name', 'role_description', 'status'];

    public const IS_SUPERADMIN = 1;
    public const IS_PRINCIPAL = 2;
    public const IS_CLASSTEACHER = 3;
    public const IS_TEACHER = 4; 
}
