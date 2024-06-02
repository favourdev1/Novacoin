<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terms= "Introduction
        Welcome to [Your Investment Site Name] (). These terms and conditions (`Terms`) govern your use of the Site and the services provided by [Your Company Name] (`the Company`). By accessing or using the Site, you agree to be bound by these Terms. If you do not agree with any part of these Terms, you must not use the Site.
        
        User Accounts
        Registration: To use certain features of the Site, you must register for an account. You agree to provide accurate and complete information during the registration process.
        Account Security: You are responsible for maintaining the confidentiality of your account information, including your password. You agree to notify us immediately of any unauthorized use of your account.
        Eligibility: By creating an account, you represent that you are at least 18 years old and have the legal capacity to enter into a binding contract.
        Investment Risks
        No Financial Advice: The Site does not provide financial advice. All information provided on the Site is for informational purposes only.
        Investment Risks: Investing involves risks, including the potential loss of principal. You acknowledge that you understand these risks and assume full responsibility for any investment decisions made based on information obtained from the Site.
        Use of the Site
        Permitted Use: You may use the Site only for lawful purposes and in accordance with these Terms.
        Prohibited Use: You agree not to use the Site:
        In any way that violates any applicable federal, state, local, or international law or regulation.
        For the purpose of exploiting, harming, or attempting to exploit or harm minors in any way.
        To transmit, or procure the sending of, any advertising or promotional material without our prior written consent.
        To impersonate or attempt to impersonate the Company, a Company employee, another user, or any other person or entity.
        Intellectual Property
        Ownership: The Site and its entire contents, features, and functionality (including but not limited to all information, software, text, displays,";

        return view('termsandconditions.terms', compact('terms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
