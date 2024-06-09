<?php

namespace App\View\Components;

use App\Enums\FeedbackTypes;
use App\Models\Platinum;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FeedbackComponent extends Component
{
    public Platinum $platinum;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $platinumId,
        public string $feedbackType = FeedbackTypes::DRAFT
    )
    {
        $this->platinum = Platinum::find($platinumId);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.feedback-component');
    }
}
