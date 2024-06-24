<?php

namespace App\Http\Middleware;

use App\Mail\WalletCredited;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;
use App\Models\InvestmentPlans;
use App\Models\UsersInvestment;
use App\Models\User;

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

        $investmentPlans = InvestmentPlans::where('status', 'active')->get();

        foreach ($investmentPlans as $plan) {
            $planStartDate = Carbon::parse($plan->created_at);
            $planEndDate = $planStartDate->copy()->addDays($plan->duration);

            if (Carbon::now()->greaterThan($planEndDate)) {

                

                // pay userallUsers with that investment plan if inivestment is 
                $usersInvestmentPlans = UsersInvestment::join('investment_plans', 'users_investments.investment_plan_id', '=', 'investment_plans.id')
                    ->where('investment_plans.id', $plan->id)
                    ->where('investment_plans.status', 'active')
                    ->first();


                if ($usersInvestmentPlans) {




                 
                    $principal = $usersInvestmentPlans->amount;
                    $rate = $usersInvestmentPlans->daily_interest;
                    $time = $usersInvestmentPlans->duration;

                    $interest = ($principal * $rate * $time) / 100;



                    $userId = $usersInvestmentPlans->user_id;
                    User::where('id', $userId)->increment('balance', $interest);
                    User::where('id', $userId)->touch();
                    $user = User::where('id', $userId)->first();

                    Mail::to($user->email)->send(new WalletCredited($user, $interest));
                }
                $plan->status = "inactive";
                $plan->save();
            }
        }

        return $next($request);
    }
}