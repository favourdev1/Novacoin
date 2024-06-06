<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersInvestment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'investment_plan_id', 'amount'];


    public function investmentPlan()
    {
        return $this->belongsTo(InvestmentPlans::class, 'investment_plan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
