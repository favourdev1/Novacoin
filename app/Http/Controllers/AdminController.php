<?php

namespace App\Http\Controllers;


use App\Mail\AccountFundedEmail;
use App\Models\Admin;
use App\Models\FundAccount;
use App\Models\InvestmentPlans;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{

    public function makAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        // check if admin with id already exists in the database
        $admin = User::where('user_id', '=', $request->user_id)->first();
        if (!$admin) {
            return redirect()->back()->withErrors(['message' => 'User does not exist']);
        }

        $admin->update([
            'role' => 'admin'
        ]);
        return view('admin.index', compact('admin'));
    }

    public function dashboard()
    {
        $greetings = 'Welcome to the admin dashboard';
        return view('admin.dashboard', compact('greetings'));
    }

    public function createInvestmentPlan(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'daily_interest' => 'required|numeric',
            'duration' => 'required|integer',
            'status' => 'required|in:active,inactive'
        ]);

        $investmentPlan = InvestmentPlans::create($request->all());
        return view('investmentPlan.index', compact('investmentPlan'));

    }

    public function getAllUsers()
    {
        $AllUsers = User::orderByRaw("role='admin' DESC")->paginate(10);
        return view('admin.users.index', compact('AllUsers'));
    }

    public function getAllFundings(Request $request)
    {
        $query = strtolower($request->query('filter'));
        if ($query == null) {

            $AllFundings = FundAccount::join('wallets', 'fund_accounts.wallet_id', '=', 'wallets.id')
                ->join('users', 'fund_accounts.user_id', '=', 'users.id')
                ->orderByRaw("CASE WHEN fund_accounts.status = 'pending' THEN 1 ELSE 2 END")
                ->select('fund_accounts.*', 'users.*', 'wallets.*', 'fund_accounts.id as fund_accountId')
                ->paginate(10);

        } else {
            $AllFundings = FundAccount::join('wallets', 'fund_accounts.wallet_id', '=', 'wallets.id')
                ->join('users', 'fund_accounts.user_id', '=', 'users.id')
                ->where('fund_accounts.status', '=', $query)
                ->paginate(10);

        }


        return view('admin.funding.index', compact('AllFundings'));
    }


    public function approvePayment(Request $request)
    {
        // validate request

        $request->validate([
            'id' => 'required|exists:fund_accounts,id'
        ]);

        $fundAccount = FundAccount::where('id', $request->id)->first();

        $userId = $fundAccount->user_id;

        $amount = $fundAccount->amount;

        $fundAccount->update([
            'status' => 'approved',
            'approved_by' => Auth::user()->id
        ]);
        $user = User::where('id', $userId)->first();

        $newBalance = $user->balance + $amount;

        $user->update([
            'balance' => $newBalance
        ]);
        session()->flash('success', 'Account Funded Successfully .');
        //send email

      

        Mail::to($user->email)->send(new AccountFundedEmail($user, $amount));

        return redirect()->back();
    }


    public function disapprovePayment(Request $request)
    {
        // validate request

        $request->validate([
            'id' => 'required|exists:fund_accounts,id'
        ]);

        $fundAccount = FundAccount::where('id', $request->id)->first();

        $userId = $fundAccount->user_id;

        $amount = $fundAccount->amount;

        $fundAccount->update([
            'status' => 'disapproved',
            'approved_by' => Auth::user()->id
        ]);
        //    send email
        session()->flash('success', 'Payment disapproved successfully.');

        return redirect()->back();
    }


}