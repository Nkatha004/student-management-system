<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectCategories extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'category_name', 'description'];

    public const MATHEMATICS = 1;
    public const LANGUAGES = 2;
    public const SCIENCES = 3;
    public const HUMANITIES = 4; 
    public const TECHNICALS = 5; 
}
