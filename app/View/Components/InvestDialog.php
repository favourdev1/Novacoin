<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InvestDialog extends Component
{
    /**
     * Create a new component instance.
     */
public $id = 'investDialog';
     public $title;
     public $description;
        public $image;
        public $buttonText = 'Invest Now';/**
   * Class constructor.
   */
  public function __construct($title, $description, $image, $buttonText = 'Invest Now', $id = 'investDialog')
  {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->buttonText = $buttonText;
$this->id = $id;
  }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.investdialog');
    }
}
