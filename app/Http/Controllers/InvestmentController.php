<?php

namespace App\Http\Controllers;

use App\Models\InvestmentPlans;
use App\Models\UsersInvestment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;



class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $investmentPlan = InvestmentPlans::paginate(10);
        return view('admin.plans.index', compact('investmentPlan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $investmentPlan = InvestmentPlans::paginate(10);
        return view('admin.plans.create', compact('investmentPlan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // create a new investment plan
        $request->validate([
            'name' => 'required|string',
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'daily_interest' => 'required|numeric',
            'duration' => 'required|integer',
            'status' => 'sometimes|in:active,inactive'
        ]);
        InvestmentPlans::create($request->all());

        $investmentPlan = InvestmentPlans::paginate(10);

        // Flash a success message to the session
        session()->flash('success', 'Investment plan created successfully.');

        // Redirect to the investment plans index page
        return redirect()->route('investmentPlan.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $investmentPlan = InvestmentPlans::findOrFail($id);
            return view('admin.plans.create', compact('investmentPlan'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Investment plan not found.');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string',
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'daily_interest' => 'required|numeric',
            'duration' => 'required|integer',
            'status' => 'sometimes|in:active,inactive'
        ]);

        $investmentPlan = InvestmentPlans::findOrFail($id);
        $investmentPlan->update($request->all());

        $investmentPlan = InvestmentPlans::paginate(10);
        // Flash a success message to the session
        session()->flash('success', 'Investment plan updated successfully.');



        // Redirect to the investment plans index page
        return redirect()->route('investmentPlan.index');

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $validatedData = Validator::make(['id' => $id], [
            'id' => 'required|exists:investment_plans,id',
        ])->validate();

        //  find or fail
        $investmentPlan = InvestmentPlans::findOrFail($id);
        $investmentPlan->delete();
        session()->flash('error', 'Investment plan deleted successfully.');

        return redirect()->back();

    }






    // ============================================
    //======== Investment for users =============
    // ===========================================

    public function showInvestmentPlans(Request $request)
    {
        // User-specific queries
        $userId = Auth::id();

        $allMyActiveInvestment = UsersInvestment::join('investment_plans', 'investment_plans.id', '=', 'users_investments.investment_plan_id')
            ->where('user_id', $userId)
            ->where('investment_plans.status', 'active')
            ->orderBy('users_investments.created_at', 'desc')
            ->get();
        $allMyEndedInvestments = UsersInvestment::join('investment_plans', 'investment_plans.id', '=', 'users_investments.investment_plan_id')
            ->where('user_id', $userId)
            ->where('investment_plans.status', 'inactive')
            ->orderBy('users_investments.created_at', 'desc')
            ->get();

        $myActiveInvestmentCount = UsersInvestment::join('investment_plans', 'investment_plans.id', '=', 'users_investments.investment_plan_id')
            ->where('user_id', $userId)
            ->where('investment_plans.status', 'active')
            ->count();

        $allUsersEndedInvestmentCount = UsersInvestment::join('investment_plans', 'investment_plans.id', '=', 'users_investments.investment_plan_id')
            ->where('user_id', $userId)
            ->orderBy('users_investments.created_at', 'desc')->count();

// all ended investment
        $allEndedInvestment = InvestmentPlans::where('status', 'inactive')->get();
        // All investment queries
        $query = strtolower($request->query('filter'));
        if ($query == null) {
            $investmentPlan = InvestmentPlans::orderByRaw('status = ? DESC', ['active'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        } else {
            $investmentPlan = InvestmentPlans::where('status', $query)
                ->orderByRaw('status = ? DESC', ['active'])
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        }

        $availbleInvestmentCount = InvestmentPlans::where('status', 'active')->count();
        $allEndedInvestmentCount = InvestmentPlans::where('status', 'inactive')->count();

        $calcInvestmentEarningsToday = $this->calcInvestmentEarningsToday($userId);
        // fetch investment earnings
        $earnings = $this->calcInvestmentEarningsMinute($userId);

        return view(
            'users.Investment.index',
            compact(
                'investmentPlan',
                'myActiveInvestmentCount',
                'availbleInvestmentCount',
                'allUsersEndedInvestmentCount',
                'allEndedInvestmentCount',
                'allMyActiveInvestment',
                'allMyEndedInvestments',
                'earnings',
                'calcInvestmentEarningsToday',
                'allEndedInvestment'
            )
        );
    }

    /**
     * Display the specified resource.
     */
    public function showInvestmentDetails(string $id)
    {
        try {
            $investmentPlan = InvestmentPlans::findOrFail($id);
            return view('users.Investment.invest', compact('investmentPlan'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Investment plan not found.');
        }
    }


    public function invest(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;

        // Validate the request
        $request->validate([
            'investment_amount' => 'required|numeric',
            'investment_plan_id' => 'required|exists:investment_plans,id',
        ]);

        // Check if user has enough balance
        if ($user->balance < $request->investment_amount) {
            session()->flash('error', 'Insufficient balance to make this investment.');
            return redirect()->back();
        }

        // Start a transaction
        DB::beginTransaction();

        try {
            $id = $request->investment_plan_id;
            $investmentPlan = InvestmentPlans::findOrFail($id);

            // Update the investment plan if needed
            $investmentPlan->update($request->all());

            // Insert user's investment record
            $userInvestment = UsersInvestment::create([
                'user_id' => $userId,
                'investment_plan_id' => $id,
                'amount' => $request->investment_amount
            ]);

            // Deduct the amount from user's balance
            $user->balance -= $request->investment_amount;
            $user->save();

            // Commit the transaction
            DB::commit();

            session()->flash('success', 'Investment plan updated and user investment created successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();

            session()->flash('error', 'Failed to create user investment. Please try again.');
            return redirect()->back();
        }

        // Redirect to the investment plans index page
        return redirect()->route('dashboard.index');
    }


    // fetch all users investment 
    public function showInvestmentRecord()
    {
        $user = Auth::user();
        $userId = $user->id;
        $investmentRecord = UsersInvestment::where('user_id', $userId)->paginate(10);
        return view('users.Investment.record', compact('investmentRecord'));
    }


    // public function calcInvestmentEarningsHourly()
    // {
    //     $investmentPlans = InvestmentPlans::where('status', 'active')->get();

    //     foreach ($investmentPlans as $plan) {
    //         $hoursPassed = Carbon::now()->diffInHours($plan->created_at);
    //         $hourlyInterest = $plan->daily_interest / 24;
    //         $earnings = $hoursPassed * $hourlyInterest;

    //         // Do something with the earnings...
    //     }
    // }


    public function calcInvestmentEarningsMinute($userId)
    {
        $earnings = 0;
        $investmentPlans = UsersInvestment::join('investment_plans', 'investment_plans.id', '=', 'users_investments.investment_plan_id')
            ->where('user_id', $userId)
            ->where('status', 'active')->get();

        foreach ($investmentPlans as $plan) {
            $now = Carbon::now();
            $minutesPassed = abs($now->diffInMinutes($plan->created_at));
            $minuteInterest = ($plan->daily_interest / 100) / (24 * 60); // Changed from 1440 to 60
            $earnings += $plan->amount * $minutesPassed * $minuteInterest;
            // Do something with the earnings...
        }

        return $earnings;
    }

    public function calcInvestmentEarningsToday($userId)
    {
        $earnings = 0;
        $investmentPlans = UsersInvestment::join('investment_plans', 'investment_plans.id', '=', 'users_investments.investment_plan_id')
            ->where('user_id', $userId)
            ->where('status', 'active')->get();
        foreach ($investmentPlans as $plan) {
            $now = Carbon::now();
            $startOfDay = clone $now;
            $startOfDay->startOfDay();

            // Check if the investment was made today
            if ($plan->created_at->isToday()) {
                $startOfDay = $plan->created_at;
            }

            $minutesPassedToday = abs($now->diffInMinutes($startOfDay));
            $minuteInterest = ($plan->daily_interest / 100) / (24 * 60);
            $earnings += $plan->amount * $minutesPassedToday * $minuteInterest;
            // Do something with the earnings...
        }

        return $earnings;
    }



    // api end point 
    public function calcInvestmentEarningsTodayAPI($userId)
    {
        // validate $user id that is passed
        // validate $userId that is passed
        if (!is_numeric($userId)) {
            return response()->json(['error' => 'Invalid user ID.'], 400);
        }

        // Check if the user exists
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }



        $earnings = 0;
        $investmentPlans = UsersInvestment::join('investment_plans', 'investment_plans.id', '=', 'users_investments.investment_plan_id')
            ->where('user_id', $userId)
            ->where('investment_plans.status', 'active')->get();
        foreach ($investmentPlans as $plan) {
            $now = Carbon::now();
            $startOfDay = clone $now;
            $startOfDay->startOfDay();

            // Check if the investment was made today
            if ($plan->created_at->isToday()) {
                $startOfDay = $plan->created_at;
            }

            $minutesPassedToday = abs($now->diffInMinutes($startOfDay));
            $minuteInterest = ($plan->daily_interest / 100) / (24 * 60);
            $earnings += $plan->amount * $minutesPassedToday * $minuteInterest;
            // Do something with the earnings...
        }

        return response()->json([
            'earnings' => $investmentPlans

        ]);
    }


    public function showMyInvesment($id)
    {



        // fix from here why its redirecting to the dashboard page 
        
  
        // Validator::make(['id' => $id], [
        //     'id' => 'required|exists:investment_plans,id',
        // ])->validate();
        // $userInvesment = UsersInvestment::join('invesment', 'investment.id', '=', 'users_investment.investment_id')->where('users_investment.user_id', Auth::id())
        //     ->where('user_investment.id', $id)->get();

        return view('users.investment.show');
    }

}