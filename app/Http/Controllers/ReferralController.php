<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
class ReferralController extends Controller
{

    public function index(){
        $referral = User::where('referrer_id', auth()->user()->referral_code)->get();
        
        return view('users.referral.index', compact('referral'));
    }
}
