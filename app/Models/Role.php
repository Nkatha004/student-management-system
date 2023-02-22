<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Role extends Model implements Auditable
{
    use HasFactory, softDeletes;
    use \OwenIt\Auditing\Auditable; 

    protected $fillable = ['id', 'role_name', 'role_description'];

    public const IS_SUPERADMIN = 1;
    public const IS_PRINCIPAL = 2;
    public const IS_CLASSTEACHER = 3;
    public const IS_TEACHER = 4; 
}
