<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\InvestmentPlans;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $investmentPlan = InvestmentPlans::orderByRaw('status = ? DESC', ['active'])
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        $faqs = Faq::all();
        $testimonials = Testimonial::all();

        return view('welcome', compact('investmentPlan','faqs','testimonials'));
    }
}
