<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\InvestmentPlans;
use App\Models\UsersInvestment;

class RunEveryTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if the day for any investment plan has passed 

        $investmentPlans = InvestmentPlans::all();
        foreach ($investmentPlans as $plan) {
            $planStartDate = Carbon::parse($plan->created_at);
            $planEndDate = $planStartDate->copy()->addDays($plan->duration);
            
            if (Carbon::now()->greaterThan($planEndDate)) {
                // $userInvestment = UsersInvestment::join('investment_plans', 'investment_plans', '=', $plan->id);

                $plan->status = "inactive";
                $plan->save();
            }
        }

        return $next($request);
    }
}