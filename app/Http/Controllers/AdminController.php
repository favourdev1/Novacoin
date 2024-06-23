<?php

namespace App\Http\Controllers;


use App\Mail\AccountFundedEmail;
use App\Mail\WithdrawalApprovedEmail;
use App\Mail\WithdrawalDisapprovedEmail;
use App\Models\Admin;
use App\Models\ContactUs;
use App\Models\Faq;
use App\Models\FundAccount;
use App\Models\InvestmentPlans;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\UsersInvestment;
use App\Models\Wallet;
use App\Models\Withdrawal;
use App\Models\WithdrawalCurrency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

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

    public function showUser($id)
    {


        // validate user
        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect()->back()->withErrors(['message' => 'User does not exist']);
        }
        // get all investment for that specific user
        $userId = $user->id;
        $investmentPlan = UsersInvestment::join('investment_plans', 'investment_plans.id', '=', 'users_investments.investment_plan_id')
            ->where('user_id', $userId)
            ->select('users_investments.*', 'investment_plans.*', 'users_investments.created_at as investment_date')
            ->paginate();

        $fundRequest = FundAccount::join('wallets', 'fund_accounts.wallet_id', '=', 'wallets.id')
            ->join('users', 'fund_accounts.user_id', '=', 'users.id')
            ->orderByRaw("CASE WHEN fund_accounts.status = 'pending' THEN 1 ELSE 2 END")
            ->select('fund_accounts.*', 'users.*', 'wallets.*', 'fund_accounts.id as fund_accountId')
            ->where('fund_accounts.user_id', $userId)
            ->paginate(10);


        // get all users withdrawal


        $Allwithdrawals = Withdrawal::join('wallets', 'withdrawals.wallet_id', '=', 'wallets.id')
            ->join('users', 'withdrawals.user_id', '=', 'users.id')
            ->select('withdrawals.*', DB::raw('CONCAT(users.firstname, " ", users.lastname) AS username'), 'users.balance as walletBalance', 'withdrawals.amount as withdrawalAmount', 'withdrawals.wallet_address as withdrawalAddress', 'wallets.wallet_name as withdrawalCurrency')

            ->orderBy('withdrawals.created_at', 'desc')
            ->where('withdrawals.user_id', $userId)
            ->paginate(10);


        // get all fund request from a specific user 
        // $fundRequest = FundAccount::where('user_id', $userId)->paginate(10);
        // echo "<pre>";
        // print_r($fundRequest);
        // die;
        return view('admin.users.show', compact('user', 'investmentPlan', 'fundRequest', 'Allwithdrawals'));
    }

    public function dashboard()
    {
        // Get the current hour
        $hour = date('H');

        // Determine the part of the day based on the current hour
        if ($hour < 12) {
            $greetings = 'Good morning, Admin';
        } elseif ($hour < 18) {
            $greetings = 'Good afternoon, Admin';
        } elseif ($hour < 22) {
            $greetings = 'Good evening, Admin';
        } else {
            $greetings = 'Good night, Admin';
        }
        $users = User::all();
        // all users investments 
        $investmentPlan = UsersInvestment::join('investment_plans', 'investment_plans.id', '=', 'users_investments.investment_plan_id')
            ->select('users_investments.*', 'investment_plans.*', 'users_investments.created_at as investment_date')
            ->get();

        // all funding request
        $fundRequest = FundAccount::join('wallets', 'fund_accounts.wallet_id', '=', 'wallets.id')->get();
        $funds = 0;
        foreach ($fundRequest as $fund) {

            $funds += $fund->amount;
        }

        // all fundings 

        $AllFundings = FundAccount::join('wallets', 'fund_accounts.wallet_id', '=', 'wallets.id')
            ->join('users', 'fund_accounts.user_id', '=', 'users.id')
            ->orderByRaw("CASE WHEN fund_accounts.status = 'pending' THEN 1 ELSE 2 END")
            ->select('fund_accounts.*', 'users.*', 'wallets.*', 'fund_accounts.id as fund_accountId')
            ->paginate(10);

        return view('admin.dashboard', compact('greetings', 'users', 'investmentPlan', 'fundRequest', 'funds', 'AllFundings'));
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



        // Mail::to($user->email)->send(new AccountFundedEmail($user, $amount));

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



    public function getAllWithdrawals(Request $request)
    {

        $query = strtolower($request->query('filter'));




        if ($query == null) {
            $Allwithdrawals = Withdrawal::join('wallets', 'withdrawals.wallet_id', '=', 'wallets.id')
                ->join('users', 'withdrawals.user_id', '=', 'users.id')
                ->select('withdrawals.*', DB::raw('CONCAT(users.firstname, " ", users.lastname) AS username'), 'users.balance as walletBalance', 'withdrawals.amount as withdrawalAmount', 'withdrawals.wallet_address as withdrawalAddress', 'wallets.wallet_name as withdrawalCurrency')
                ->whereNotIn('withdrawals.status', ['email_pending'])
                ->orderBy('withdrawals.created_at', 'desc')
                ->paginate(10);
        } else {
            $Allwithdrawals = Withdrawal::join('wallets', 'withdrawals.wallet_id', '=', 'wallets.id')
                ->join('users', 'withdrawals.user_id', '=', 'users.id')
                ->select('withdrawals.*', DB::raw('CONCAT(users.firstname, " ", users.lastname) AS username'), 'users.balance as walletBalance', 'withdrawals.amount as withdrawalAmount', 'withdrawals.wallet_address as withdrawalAddress', 'wallets.wallet_name as withdrawalCurrency')
                ->where('withdrawals.status', '=', $query)
                ->orderBy('withdrawals.created_at', 'desc')
                ->paginate(10);
        }

        // foreach ($withdrawals as $withdrawal) {
        //     echo "<pre>";
        //     print_r($withdrawal);
        // }
        // die;
        return view('admin.withdrawal.index', compact('Allwithdrawals'));

    }


    public function approveWithdrawal(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:withdrawals,id'
        ]);

        $withdrawal = Withdrawal::where('id', $request->id)->first();

        // Check if withdrawal has already been approved
        if ($withdrawal->status == 'approved') {
            session()->flash('error', 'This withdrawal has already been approved.');
            return redirect()->back();
        }

        // Check if user has not yet validated their email
        if ($withdrawal->status == "email_pending") {
            session()->flash('error', 'This user hasnt verified his email yet');
            return redirect()->back();
        }

        $user = User::where('id', $withdrawal->user_id)->first();

        // Check if balance is enough 
        if ($user->balance < $withdrawal->amount) {
            session()->flash('error', 'This user Balance is not enough for this disbursement');
            return redirect()->back();
        }

        // Start transaction
        DB::beginTransaction();

        try {
            $withdrawal->update([
                'status' => 'approved',
                'approved_by' => Auth::user()->id
            ]);

            $user->update([
                'balance' => $user->balance - $withdrawal->amount
            ]);

            // Commit the transaction
            DB::commit();

            session()->flash('success', 'Account Funded Successfully .');

            // Send email
            Mail::to($withdrawal->user->email)->send(new WithdrawalApprovedEmail($withdrawal));


            return redirect()->back();
        } catch (\Exception $e) {
            // An error occurred; cancel the transaction...
            DB::rollback();

            // and return to the previous page with an error message
            session()->flash('error', 'An error occurred while processing the withdrawal.' . $e->getMessage());
            return redirect()->back();
        }
    }




    public function disapproveWithdrawal(Request $request)
    {

        $request->validate([
            'id' => 'required|exists:withdrawals,id',
            'reason' => 'required'
        ]);

        $withdrawal = Withdrawal::where('id', $request->id)->first();

        // Check if withdrawal has already been disapproved
        if ($withdrawal->status == 'disapproved') {
            session()->flash('error', 'This withdrawal has already been disapproved.');
            return redirect()->back();
        }

        // Start transaction
        DB::beginTransaction();

        try {
            $withdrawal->update([
                'status' => 'declined',
                'decline_reason' => $request->reason
            ]);

            // Commit the transaction
            DB::commit();

            session()->flash('success', 'Withdrawal Disapproved Successfully.');

            // Send email
            Mail::to($withdrawal->user->email)->send(new WithdrawalDisapprovedEmail($withdrawal, $request->reason));

            return redirect()->back();
        } catch (\Exception $e) {
            // An error occurred; cancel the transaction...
            DB::rollback();


            // and return to the previous page with an error message
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
    }




    // wallets 
    public function showWallet()
    {
        $wallets = Wallet::paginate();
        return view('admin.wallet.index', compact('wallets'));
    }

    public function createWallet(Request $request)
    {

        $request->validate([
            'wallet_name' => 'required|string|unique:wallets,wallet_name',
            'wallet_address' => 'required|string'
        ]);

        $wallet = Wallet::create($request->all());
        $wallets = Wallet::paginate();
        return view('admin.wallet.index', compact('wallets'));
    }


    public function updateWallet(Request $request)
    {
        $request->validate([
            'wallet_name' => 'required|string|',

            'wallet_address' => 'required|string',
            'id' => 'required|exists:wallets,id'
        ]);

        $wallet = Wallet::where('id', $request->id)->first();
        $wallet->update($request->all());
        $wallets = Wallet::paginate();
        return view('admin.wallet.index', compact('wallets'));
    }

    public function deleteWallet($id)
    {
        //    validate


        $wallet = Wallet::where('id', $id)->first();
        $wallet->delete();
        $wallets = Wallet::paginate();

        return view('admin.wallet.index', compact('wallets'));

    }

    public function showWalletForm()
    {
        return view('admin.wallet.create');
    }

    public function showWalletDetails($id)
    {
        $wallet = Wallet::where('id', $id)->first();
        return view('admin.wallet.create', compact('wallet'));
    }




    // ============================================================================
    // ================= FAQ =====================================================
    // ============================================================================
    public function showFaq()
    {
        $faqs = Faq::paginate();
        return view('admin.faq.index', compact('faqs'));
    }

    public function createFaq(Request $request)
    {
        $request->validate([
            'category' => 'sometimes|string',
            'question' => 'required|string',
            'answer' => 'required|string'
        ]);

        $faq = Faq::create($request->all());
        $faqs = Faq::paginate();
        return view('admin.faq.index', compact('faqs'));
    }

    public function updateFaq(Request $request)
    {
        $request->validate([
            'category' => 'sometimes|string',
            'question' => 'required|string',
            'answer' => 'required|string',
            'id' => 'required|exists:faqs,id'
        ]);

        $faq = Faq::where('id', $request->id)->first();
        $faq->update($request->all());
        $faqs = Faq::paginate();
        return view('admin.faq.index', compact('faqs'));
    }

    public function deleteFaq($id)
    {
        $faq = Faq::where('id', $id)->first();
        $faq->delete();
        $faqs = Faq::paginate();
        return view('admin.faq.index', compact('faqs'));
    }

    public function showFaqForm()
    {
        return view('admin.faq.create');
    }


    public function showFaqDetails($id)
    {
        $faq = Faq::where('id', $id)->first();
        return view('admin.faq.create', compact('faq'));
    }


    // ============================================================================
    // ================= TESTIMONIAL =====================================================
    // ============================================================================


    public function showTestimonial()
    {
        $testimonials = Testimonial::paginate();
        return view('admin.testimonial.index', compact('testimonials'));
    }

    public function createTestimonial(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'message' => 'required|string',
            'image' => 'required|image'
        ]);

        $testimonial = new Testimonial();
        $testimonial->name = $request->name;
        $testimonial->message = $request->message;
        $testimonial->image = asset('storage/' . $request->image->store('testimonials', 'public'));
        $testimonial->save();

        $testimonials = Testimonial::paginate();
        return view('admin.testimonial.index', compact('testimonials'));

    }
    public function updateTestimonial(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'message' => 'required|string',
            'image' => 'sometimes|image',
            'id' => 'required|exists:testimonials,id'
        ]);

        $testimonial = Testimonial::where('id', $request->id)->first();
        $testimonial->name = $request->name;
        $testimonial->message = $request->message;
        if ($request->hasFile('image')) {
            $testimonial->image = asset('storage/' . $request->image->store('testimonials', 'public'));
        }
        $testimonial->save();
        $testimonials = Testimonial::paginate();
        return view('admin.testimonial.index', compact('testimonials'));
    }

    public function deleteTestimonial($id)
    {
        $testimonial = Testimonial::where('id', $id)->first();
        if ($testimonial) {
            $testimonial->delete();
            return redirect()->route('admin.setting.testimonial')->with('success', 'Testimonial deleted successfully.');
        } else {
            return redirect()->route('admin.setting.testimonial')->with('error', 'Testimonial not found.');
        }
    }


    public function showTestimonialForm()
    {
        return view('admin.testimonial.create');
    }

    public function showTestimonialDetails($id)
    {

        $testimonial = Testimonial::where('id', $id)->first();
        return view('admin.testimonial.create', compact('testimonial'));

    }



    // ============================================================================
    // ================= Withdrawal Currencies=============================================
    // ============================================================================
    public function showWithdrawalCurrencies()
    {
        $withdrawalCurrencies = WithdrawalCurrency::paginate();
        return view('admin.withdrawalCurrency.index', compact('withdrawalCurrencies'));
    }


    public function createWithdrawalCurrencies(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'sometimes|string'
        ]);

        $withdrawalCurrency = WithdrawalCurrency::create($request->all());
        $withdrawalCurrencies = WithdrawalCurrency::paginate();
        return redirect()->route('admin.setting.withdrawalcurrencies', compact('withdrawalCurrencies'));
    }

    public function updateWithdrawalCurrencies(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'type' => 'sometimes|string',
            'id' => 'required|exists:withdrawal_currencies,id'
        ]);

        $withdrawalCurrency = WithdrawalCurrency::where('id', $request->id)->first();
        $withdrawalCurrency->update($request->all());
        $withdrawalCurrencies = WithdrawalCurrency::paginate();
        return view('admin.withdrawalCurrency.index', compact('withdrawalCurrencies'));
    }


    public function deleteWithdrawalCurrencies($id)
    {
        $withdrawalCurrency = WithdrawalCurrency::where('id', $id)->first();
        $withdrawalCurrency->delete();
        $withdrawalCurrencies = WithdrawalCurrency::paginate();
        return view('admin.withdrawalCurrency.index', compact('withdrawalCurrencies'));
    }

    public function showWithdrawalCurrenciesDetails($id)
    {
        $withdrawalCurrency = WithdrawalCurrency::where('id', $id)->first();
        return view('admin.withdrawalCurrency.create', compact('withdrawalCurrency'));
    }


    public function showWithdrawalCurrenciesForm()
    {
        return view('admin.withdrawalCurrency.create');
    }


    // ============================================================================
    // ================= Complaints  ============================================
    // ============================================================================
    public function showComplaints()
    {
        $complaints = ContactUs::join('users', 'contact_us.user_id', '=', 'users.id')
            ->select('contact_us.*') // Select all columns from ContactUs
            ->orderby('contact_us.created_at', 'desc')
            ->paginate();
        return view('admin.complaint.index', compact('complaints'));
    }

    public function showComplaintsDetails($id)
    {
        $complaint = ContactUs::where('id', $id)->first();
        // make the message as read
        $complaint->update([
            'status' => 'read'
        ]);

        
        return view('admin.complaint.create', compact('complaint'));
    }

    public function deleteComplaints($id)
    {
        $complaint = ContactUs::where('id', $id)->first();
        $complaint->delete();
        $complaints = ContactUs::join('users', 'contact_us.user_id', '=', 'users.id')
            ->select('contact_us.*') // Select all columns from ContactUs
            ->paginate();
        return view('admin.complaint.index', compact('complaints'));
    }


}