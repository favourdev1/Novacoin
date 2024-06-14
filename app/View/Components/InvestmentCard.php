<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InvestmentCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $investmentName;
    public $investmentAmount;
    public $investmentStatus;
    public $minInvestment;
    public $maxInvestment;
    public $investmentDuration;
    public $dailyInterest;
    public $investmentId;
    public $isActive;

    public function __construct($investmentId,$investmentName, $investmentAmount, $investmentStatus, $minInvestment, $maxInvestment, $investmentDuration, $dailyInterest,$isActive=true)
    {
        $this->investmentId = $investmentId;
        $this->investmentName = $investmentName;
        $this->investmentAmount = $investmentAmount;
        $this->investmentStatus = $investmentStatus;
        $this->minInvestment = $minInvestment;
        $this->maxInvestment = $maxInvestment;
        $this->investmentDuration = $investmentDuration;
        $this->dailyInterest = $dailyInterest;
        $this->isActive = $isActive;
    }
  

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.investment-card');
    }
}
