<?php

namespace App\Actions\Fortify;

use App\Http\Controllers\AccountController;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'referral_id'=>['sometimes','nullable'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        $randomAccountNumber = AccountController::generateAccountNumber();
    
        return User::create([
            
            'username' => $input['username'],
            'account_number'=>$randomAccountNumber,
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'email' => $input['email'],
            'referrer_id'=>$input['referral_id'],
            'password' => Hash::make($input['password']),
            'referral_code' => $this->generateReferralCode()
        ]);
    }

    public function generateReferralCode()
    {
        $referralCode = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
        $users  = User::where('referral_code', $referralCode)->get();
        if ($users->count() > 0) {
            $this->generateReferralCode();
        }
        return $referralCode;
    }
}
