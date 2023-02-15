<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MpesaPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id','transaction_id','transaction_date', 'currency', 'amount','phone_number','paid_by'];
}
