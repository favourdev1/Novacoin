<?php

namespace App\Http\Controllers;

use App\Models\FundAccount;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FundAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Wallets = Wallet::all();
        return view('users.fundAccount.fundAccount', compact('Wallets'));

    }


    public function processPayment(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required|exists:wallets,id',
            'amount' => 'required|numeric',

        ]);
        $wallet_id = $request->wallet_id;
        $amount = $request->amount;
        $cryptoWallet = Wallet::where('id', '=', $wallet_id)->first();


        return view('users.fundAccount.pendingPayment', compact('wallet_id', 'amount', 'cryptoWallet'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required|numeric|exists:wallets,id',
            'amount' => 'required|numeric',
            'payment_proof' => 'required|file|mimes:png,jpeg,jpg,pdf|max:2048',
        ]);

        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/payment_proofs', $filename);

            $fundAccount = new FundAccount();
            $fundAccount->wallet_id = $request->wallet_id;
            $fundAccount->amount = $request->amount;
            $fundAccount->payment_proof = $filename;
            $fundAccount->user_id = Auth::user()->id;
            $fundAccount->save();

            return redirect()->back()->with('success', 'Fund account created successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload payment proof.');
    }
    public function showDepositRecord(Request $request)
    {
        $userId = Auth::user()->id;
        $query = strtolower($request->query('filter'));
        if ($query == null) {

            $AllFundings = FundAccount::join('wallets', 'wallets.id', '=', 'fund_accounts.wallet_id')->
                where('fund_accounts.user_id', $userId)->paginate(10);
        } else {
            $AllFundings = FundAccount::join('wallets', 'wallets.id', '=', 'fund_accounts.wallet_id')
                ->join('users', 'fund_accounts.user_id', '=', 'users.id')
                ->where('fund_accounts.status', '=', $query)
                ->where('users.id', '=', $userId)
                ->paginate(10);

        }
        return view('users.fundAccount.depositRecord', compact('AllFundings'));
    }



}