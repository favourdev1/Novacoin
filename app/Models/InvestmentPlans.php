<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentPlans extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'min_amount',
        'max_amount',
        'daily_interest',
        'duration',
        'status'
    ];
}
