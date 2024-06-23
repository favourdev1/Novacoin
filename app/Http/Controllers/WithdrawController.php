<?php

namespace App\Http\Controllers;

use App\Mail\WithdrawalCreated;
use App\Models\Withdrawal;
use App\Models\withdrawal_token;
use App\Models\WithdrawalCurrency;
use Database\Seeders\WalletCurrenySeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;

class WithdrawController extends Controller
{
    public function index()
    {
        $WalletCurrencies = WithdrawalCurrency::all();
        return view('users.withdraw.index', compact('WalletCurrencies'));
    }

    public function withdrawFund(Request $request)
    {
        // validate requst
        $request->validate([
            'walletAddress' => 'required|string',
            'withdrawalAmount' => 'required|numeric',
            'wallet_id' => 'required|string',

        ]);




        // process withdrawal
        $withdrawal = new Withdrawal();
        $withdrawal->user_id = auth()->user()->id;
        $withdrawal->wallet_id = $request->wallet_id;
        $withdrawal->wallet_address = $request->walletAddress;
        $withdrawal->amount = $request->withdrawalAmount;
        $withdrawal->status = 'email_pending';
        $withdrawal->save();


        $withdrawId = $withdrawal->id;

        // save infomation to the withdrawal_token
        $withdrawalToken = new withdrawal_token();
        $withdrawalToken->token = bin2hex(random_bytes(32));
        $withdrawalToken->user_id = auth()->user()->id;
        $withdrawalToken->withdrawal_id = $withdrawId;
        $withdrawalToken->save();


        // send email to the user 


        Mail::to(auth()->user()->email)->send(new WithdrawalCreated($withdrawal, $withdrawalToken));
        return redirect()->route('withdrawals.record')->with('success', 'Withdrawal request sent successfully');
    }

    // public function withdrawFund(Request $request)
    // {
    //     // send them an email token to confirm their email
    //     // save the information to the database and set the status to pending
    //     // send an email to the user to confirm the withdrawal

    //     // validate the request
    //     $request->validate([
    //         'walletAddress' => 'required|string',
    //         'withdrawalAmount' => 'required|numeric',
    //         'wallet_id' => 'required|string|exists:withdrawal_currencies,id',

    //     ]);

    //     // check if the user has enough balance
    //     if (auth()->user()->balance < $request->withdrawalAmount) {
    //         return redirect()->back()->with('error', 'Insufficient balance');
    //     }

    //     // process withdrawal
    //     $withdrawal = new Withdrawal();
    //     $withdrawal->user_id = auth()->user()->id;
    //     $withdrawal->wallet_id = $request->wallet_id;
    //     $withdrawal->wallet_address = $request->walletAddress;
    //     $withdrawal->amount = $request->withdrawalAmount;
    //     $withdrawal->status = 'email_pending';
    //     $withdrawal->save();






    //     // // send email to the user
    //     // Mail::to(auth()->user()->email)->send(new WithdrawalCreated($withdrawal));

    //     // send admin an email

    //     return redirect()->back()->with('success', 'Withdrawal request sent successfully');

    // }

    public function confirmWithdrawal($token)
    {
        $withdrawaltoken = withdrawal_token::where('token', $token)
        ->with('user')
        ->first();
        if (!$withdrawaltoken) {
            return view('dashboard')->with->with('error', 'Invalid token');
        }
        $id = $withdrawaltoken->withdrawal_id;


        // check if the withdrawal exists
        $withdrawal = Withdrawal::find($id);
        if (!$withdrawal) {
            return view('dashboard')->with->with('error', 'Withdrawal not found');
        }

        // update the withdrawal status
        $withdrawal->status = 'pending';
        $withdrawal->save();

        // delete the token
        $withdrawaltoken->delete();

        // update thee user wallet balance
        $user = auth()->user();
        $user->balance = $user->balance - $withdrawal->amount;
        $user->save();

        // return user to the dashboard route 
        return view('dashboard')->with('success', 'Withdrawal confirmed successfully');
    }

    public function showWithdrawRecord(Request $request)
    {
        $filter = $request->query('filter');

        $Mywithdrawals = Withdrawal::where('withdrawals.user_id', auth()->user()->id)
            ->when($filter, function ($query, $filter) {
                return $query->where('status', $filter);
            })
            ->join('withdrawal_currencies', 'withdrawals.wallet_id', '=', 'withdrawal_currencies.id')
            ->orderBy('withdrawals.created_at', 'desc')
            ->select('withdrawals.*', 'withdrawal_currencies.name as currency_name')
            ->paginate(10);

        return view('users.withdraw.record', compact('Mywithdrawals'));
    }
}