<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class LandingLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.landing');
    }
}
