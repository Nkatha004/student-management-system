<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaypalPayment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'transaction_id','payer_id','payer_email','amount','currency', 'payment_status', 'paid_by'];
}