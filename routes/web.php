<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FundAccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\WithdrawController;
use App\Http\Middleware\RunEveryTime;
use App\Mail\WithdrawalCreated;
use App\Mail\WithdrawalDisapprovedEmail;
use App\Models\Withdrawal;
use App\Models\withdrawal_token;
use Illuminate\Support\Facades\Route;



Route::middleware(RunEveryTime::class)->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Route::middleware([
    //     'auth:sanctum',
    //     config('jetstream.auth_session'),
    //     'verified',
    // ])->group(function () {
    //     Route::get('/dashboard', function () {
    //         return view('dashboard');
    //     })->name('dashboard');
    // });


    // terms and policy 
    Route::get('/terms', [TermsController::class, 'index'])->name('terms');
    // privacy policy
    Route::get('/privacyPolicy', function () {
        return view('termsandconditions.policy');
    })->name('privacyPolicy');
    Route::controller(ContactUsController::class)->group(function () {
        Route::get('/contact', 'index')->name('contact.index');

        Route::post('/contact', 'store')->name('contact.store');
    });


    Route::get('/about', function () {
        return view('about');
    });


    // Users  authenticated routes
    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {

        Route::middleware(['isUser'])->group(function () {
            Route::prefix('dashboard')->group(function () {
                Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');



                // fund account - deposit record 
                Route::controller(FundAccountController::class)->group(function () {

                    Route::get('/fundAccount', 'index')->name('fundAccount.index');
                    Route::post('/fundAccount', 'processPayment')->name('fundAccount.processPayment');
                    Route::post('/fundAccount/store', 'store')->name('fundAccount.store');
                    Route::get('/deposit/record', 'showDepositRecord')->name('deposit.record');

                });


                Route::controller(WithdrawController::class)->group(function () {
                    Route::get('/withdraw', 'index')->name('withdraw.index');
                    Route::post('/withdraw', 'withdrawFund')->name('withdraw.fund');

                    Route::get('/withdraw/record', 'showWithdrawRecord')->name('withdrawals.record');

                    Route::get('/confirm/withdraw/{token}', 'confirmWithdrawal')->name('confirm.withdraw');
                });

                // Investment Route for users 
                Route::controller(InvestmentController::class)->group(function () {
                    Route::get('/investment', 'showInvestmentPlans')->name('investment.index');

                    Route::get('/investment/{id}', 'showInvestmentDetails')->name('investment.show');
                    Route::post('/invest', 'invest')->name('investment.in.plan');
                    Route::get('/investment/show/{id}', 'showMyInvesment')->name('show.my.Investment');
                });

                Route::controller(ReferralController::class)->group(function () {
                    Route::get('/referal', 'index')->name('referal.index');
                    // Route::post('/withdraw', 'withdraw')->name('withdraw.withdraw');
                    // Route::get('/withdraw/record', 'showWithdrawRecord')->name('withdrawals.record');

                });

            });
        });



        Route::middleware(['isAdmin'])->group(function () {
            Route::prefix('admin')->group(function () {


                // iinvestment route
                Route::controller(InvestmentController::class)->group(function () {
                    Route::get('/plan', 'index')->name('investmentPlan.index');
                    Route::get('/create', 'create')->name('investmentPlan.create');
                    Route::get('/plan/{id}', 'show')->name('investmentPlan.show');
                    Route::put('/plan/{id}', 'update')->name('investmentPlan.update');
                    Route::delete('/plan/{id}', 'destroy')->name('investmentPlan.destroy');
                    Route::post('/plan', 'store')->name('investmentPlan.store');
                });

                // Admin routes
                Route::controller(AdminController::class)->group(function () {
                    Route::post('/makeAdmin', 'makeAdmin')->name('admin.makeAdmin');
                    Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
                    Route::get('/users', 'getAllUsers')->name('admin.users');
                    Route::get('/users/{id}', 'showUser')->name('admin.showUser');
                    // ==========================================
                    // ============== FUNDING ================
                    // ==========================================
                    Route::get('/fundings', 'getAllFundings')->name('admin.fundings');
                    Route::post('/funding/approvePayment', 'approvePayment')->name('admin.approvePayment');
                    Route::post('/funding/disapprovePayment', 'disapprovePayment')->name('admin.disapprovePayment');
                    // ==========================================
                    // ============== WITHDRAWAL ================
                    // ==========================================
                    Route::get('/withdrawals', 'getAllWithdrawals')->name('admin.withdrawals');
                    Route::post('/withdrawal/approveWithdrawal', 'approveWithdrawal')->name('admin.approveWithdrawal');
                    Route::post('/withdrawal/disapproveWithdrawal', 'disapproveWithdrawal')->name('admin.disapproveWithdrawal');

                    // ==========================================
                    // ============== WALLET ================
                    // ==========================================
                    Route::get('/settings/wallet','showWallet')->name('admin.setting.wallet');
                    Route::get('/settings/wallet/create','showWalletForm')->name('admin.setting.wallet.create');
                    Route::post('/settings/wallet/store','createWallet')->name('admin.setting.wallet.store');
                    Route::get('/settings/wallet/{id}','showWalletDetails')->name('admin.setting.wallet.show');
                    Route::put('/settings/wallet/{id}','updateWallet')->name('admin.setting.wallet.update');
                    Route::delete('/settings/wallet/{id}','deleteWallet')->name('admin.setting.wallet.destroy');


                    // ==========================================
                    // ============== FAQ ================
                    // ==========================================
                    Route::get('/settings/faq','showFaq')->name('admin.setting.faq');
                    Route::get('/settings/faq/create','showFaqForm')->name('admin.setting.faq.create');
                    Route::post('/settings/faq/store','createFaq')->name('admin.setting.faq.store');
                    Route::get('/settings/faq/{id}','showFaqDetails')->name('admin.setting.faq.show');
                    Route::put('/settings/faq/{id}','updateFaq')->name('admin.setting.faq.update');
                    Route::delete('/settings/faq/{id}','deleteFaq')->name('admin.setting.faq.destroy');


                    // ==========================================
                    // ============== testimonial ================
                    // ==========================================
                    Route::get('/settings/testimonial','showTestimonial')->name('admin.setting.testimonial');   
                    Route::get('/settings/testimonial/create','showTestimonialForm')->name('admin.setting.testimonial.create');
                    Route::post('/settings/testimonial/store','createTestimonial')->name('admin.setting.testimonial.store');
                    Route::get('/settings/testimonial/{id}','showTestimonialDetails')->name('admin.setting.testimonial.show');
                    Route::put('/settings/testimonial/{id}','updateTestimonial')->name('admin.setting.testimonial.update');
                    Route::delete('/settings/testimonial/{id}','deleteTestimonial')->name('admin.setting.testimonial.destroy');


                    // ==========================================
                    // ============== withdrawalcurrencies ================
                    // ==========================================
                    Route::get('/settings/withdrawalcurrencies','showWithdrawalCurrencies')->name('admin.setting.withdrawalcurrencies');
                    Route::get('/settings/withdrawalcurrencies/create','showWithdrawalCurrenciesForm')->name('admin.setting.withdrawalcurrencies.create');
                    Route::post('/settings/withdrawalcurrencies/store','createWithdrawalCurrencies')->name('admin.setting.withdrawalcurrencies.store');
                    Route::get('/settings/withdrawalcurrencies/{id}','showWithdrawalCurrenciesDetails')->name('admin.setting.withdrawalcurrencies.show');
                    Route::put('/settings/withdrawalcurrencies/{id}','updateWithdrawalCurrencies')->name('admin.setting.withdrawalcurrencies.update');

                    Route::delete('/settings/withdrawalcurrencies/{id}','deleteWithdrawalCurrencies')->name('admin.setting.withdrawalcurrencies.destroy');
                    

                    // ===========================================================
                    // ==================  Complaints ======================
                    // ==========================================================

                    Route::get('/settings/complaints','showComplaints')->name('admin.setting.complaints');
                    // Route::get('/settings/complaints/{id}','showComplaintsDetails')->name('admin.setting.complaints.show');
                    // // delete complaints
                    // Route::delete('/settings/complaints/{id}','deleteComplaints')->name('admin.setting.complaints.destroy');


                });
            });
        });



    });

});


Route::get('/mailable', function () {
    $user = App\Models\User::find(1); // Fetch the user
    $amount = 100; // Set the amount

    return new App\Mail\AccountFundedEmail($user, $amount); // Replace with your actual namespace and class
});

Route::get('/mailable2', function () {

    $withdrawal = new Withdrawal();
    $withdrawal->user_id = 1;
    $withdrawal->wallet_id = 1;
    $withdrawal->wallet_address = 'test address';
    $withdrawal->amount = 100;
    $withdrawal->status = 'pending';
    $withdrawal->save();


    // save infomation to the withdrawal_token
    $withdrawalToken = new withdrawal_token();
    $withdrawalToken->token = bin2hex(random_bytes(32));
    $withdrawalToken->user_id = auth()->user()->id;
    $withdrawalToken->withdrawal_id = 1;
    $withdrawalToken->save();

    return new WithdrawalCreated($withdrawal, $withdrawalToken);
});

// withdrawal email test 
Route::get('/mailable3', function () {
    $withdrawal = Withdrawal::first(); // get the first withdrawal
    return new WithdrawalDisapprovedEmail($withdrawal, 'Test reason');
});