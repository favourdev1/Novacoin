<?php

namespace App\Http\Controllers;

use App\Mail\WithdrawalCreated;
use App\Models\Withdrawal;
use App\Models\WithdrawalCurrency;
use Database\Seeders\WalletCurrenySeeder;
use Illuminate\Http\Request;
use Mail;

class WithdrawController extends Controller
{
    public function index()
    {
        $WalletCurrencies = WithdrawalCurrency::all();
        return view('users.withdraw.index', compact('WalletCurrencies'));
    }

    public function sendWithdrawal(Request $request){
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
        $withdrawal->status = 'pending';
        $withdrawal->save();


        // send email to the user 

        
Mail::to(auth()->user()->email)->send(new WithdrawalCreated($withdrawal));

    }
}
