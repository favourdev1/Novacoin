<?php

;
use App\Http\Controllers\InvestmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/todayEarnings/{id}', [InvestmentController::class, 'calcInvestmentEarningsTodayAPI'])->name('todayEarnings.Api');