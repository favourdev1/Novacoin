<?php

namespace App\Http\Controllers;

use App\Models\InvestmentPlans;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $investmentPlan = InvestmentPlans::paginate(10);
        return view('admin.plans.index', compact('investmentPlan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $investmentPlan = InvestmentPlans::paginate(10);
        return view('admin.plans.create', compact('investmentPlan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // create a new investment plan
        $request->validate([
            'name' => 'required|string',
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'daily_interest' => 'required|numeric',
            'duration' => 'required|integer',
            'status' => 'sometimes|in:active,inactive'
        ]);
        InvestmentPlans::create($request->all());

        $investmentPlan = InvestmentPlans::paginate(10);

        // Flash a success message to the session
        session()->flash('success', 'Investment plan created successfully.');

        // Redirect to the investment plans index page
        return redirect()->route('investmentPlan.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $investmentPlan = InvestmentPlans::findOrFail($id);
            return view('admin.plans.create', compact('investmentPlan'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Investment plan not found.');
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string',

            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'daily_interest' => 'required|numeric',
            'duration' => 'required|integer',
            'status' => 'sometimes|in:active,inactive'
        ]);

        $investmentPlan = InvestmentPlans::findOrFail($id);
        $investmentPlan->update($request->all());

        $investmentPlan = InvestmentPlans::paginate(10);
        // Flash a success message to the session
        session()->flash('success', 'Investment plan updated successfully.');



        // Redirect to the investment plans index page
        return redirect()->route('investmentPlan.index');

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {
        $validatedData = Validator::make(['id' => $id], [
            'id' => 'required|exists:investment_plans,id',
        ])->validate();

        //  find or fail
        $investmentPlan = InvestmentPlans::findOrFail($id);
        $investmentPlan->delete();
        session()->flash('error', 'Investment plan deleted successfully.');

        return redirect()->back();

    }






    // ============================================
    //======== Investment for users =============
    // ===========================================
    public function showInvestmentPlans(Request $request)
    {
        $query = strtolower($request->query('filter'));
        if ($query == null) {

            $investmentPlan = InvestmentPlans::orderByRaw('status = ? DESC', ['active'])->paginate(10);
        } else {
            $investmentPlan = InvestmentPlans::where('status', $query)
                ->orderByRaw('status = ? DESC', ['active'])
                ->paginate(10);
        }
        return view('users.Investment.index', compact('investmentPlan'));
    }

    /**
     * Display the specified resource.
     */
    public function showInvestmentDetails(string $id)
    {
        try {
            $investmentPlan = InvestmentPlans::findOrFail($id);
            return view('users.Investment.invest', compact('investmentPlan'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Investment plan not found.');
        }
    }


    public function invest(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'investment_plan_id' => 'required|exists:investment_plans,id',
        ]);
        $id = $request->investment_plan_id;
        $investmentPlan = InvestmentPlans::findOrFail($id);
        $investmentPlan->updatFe($request->all());

        $investmentPlan = InvestmentPlans::paginate(10);
        // Flash a success message to the session
        session()->flash('success', 'Investment plan updated successfully.');

        // Redirect to the investment plans index page
        return redirect()->route('investmentPlan.index');
    }
}