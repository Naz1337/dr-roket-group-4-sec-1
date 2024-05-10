<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProfileInHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $profilePicture = "/assets/images/profile/user-1.jpg"
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.profile-in-header');
    }
}
