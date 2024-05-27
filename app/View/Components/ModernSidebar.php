<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModernSidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $companyLogo = "/assets/images/logos/dark-logo.svg")
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modern-sidebar');
    }
}
