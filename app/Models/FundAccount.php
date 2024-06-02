<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'wallet_id',
        'amount',
        'payment_proof',
        'status',
        'approved_by',
    ];
}