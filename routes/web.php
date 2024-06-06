<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FundAccountController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\WithdrawController;
use App\Http\Middleware\RunEveryTime;
use Illuminate\Support\Facades\Route;



Route::middleware(RunEveryTime::class) ->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });


    // terms and policy 
    Route::get('/terms', [TermsController::class, 'index'])->name('terms');
    // privacy policy
    Route::get('/privacyPolicy', function () {
        return view('termsandconditions.policy');
    })->name('privacyPolicy');




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
                });

                // Investment Route for users 
                Route::controller(InvestmentController::class)->group(function () {
                    Route::get('/investment', 'showInvestmentPlans')->name('investment.index');

                    Route::get('/investment/{id}', 'showInvestmentDetails')->name('investment.show');
                    Route::post('/invest', 'invest')->name('investment.in.plan');
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
                    Route::get('/fundings', 'getAllFundings')->name('admin.fundings');
                    Route::post('/approvePayment', 'approvePayment')->name('admin.approvePayment');
                    Route::post('/disapprovePayment', 'disapprovePayment')->name('admin.disapprovePayment');
                });
            });
        });



    });

});