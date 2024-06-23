<?php

namespace App\Http\Controllers;

use App\Models\UsersInvestment;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // greeting the user
        $greetings = 'Hello, ' . auth()->user()->username;
        $referrals = User::where('referrer_id', auth()->user()->referral_code)->get();
        $userId = auth()->user()->id;
        $investmentController = new InvestmentController();
        $calcInvestmentEarningsToday = $investmentController->calcInvestmentEarningsToday($userId);


        $myActiveInvestmentCount = UsersInvestment::join('investment_plans', 'investment_plans.id', '=', 'users_investments.investment_plan_id')
            ->where('user_id', $userId)
            ->where('investment_plans.status', 'active')
            ->count();
        $earnings = $investmentController->calcInvestmentEarningsMinute($userId);
        return view('dashboard', compact('greetings', 'referrals','calcInvestmentEarningsToday','earnings','myActiveInvestmentCount'));
    }

    
}