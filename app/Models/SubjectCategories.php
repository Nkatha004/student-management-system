<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectCategories extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'category_name', 'description'];
}
