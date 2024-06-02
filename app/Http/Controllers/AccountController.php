<?php

namespace App\Http\Controllers;

use App\Models\User
;
use Illuminate\Http\Request;

class AccountController extends Controller
{

    public static function generateAccountNumber()
    {
        $randomValue = rand(1000000000, 9999999999);
        $accountDb = User::where('account_number', $randomValue)->first();
        if ($accountDb) {
           return  self::generateAccountNumber();
        }else{
            return $randomValue;
            
        }
    }
}