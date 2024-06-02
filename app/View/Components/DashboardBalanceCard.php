<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardBalanceCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $info;
    public $amount;

    public function __construct($title, $info, $amount)
    {
        $this->title = $title;
        $this->info = $info;
        $this->amount = $amount;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-balance-card');
    }
}
