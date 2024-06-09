<x-modern-layout title="My Weekly Foci">
    @vite('resources/scss/focus_index.scss')
    <div class="card">
        <div class="card-body">
            <h3 class="mb-4">My Weekly Focuses</h3>
            <a href="{{ route('weekly-focus.create', ['focus' => 5, 'admin' => 5, 'social' => 5, 'recovery' => 5]) }}" class="btn btn-primary mb-4">Create New Weekly Focus</a>
            <div class="row">
                @foreach($weeklyFocuses as $weeklyFocus)
                    <div class="col-4">
                        <div class="card week-item shadow-lg">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <a href="{{ route('weekly-focus.show', ['weekly_focu' => $weeklyFocus]) }}" class="text-muted fw-bolder stretched-link">
                                    {{ $loop->iteration }}. {{ $weeklyFocus->start_date }} - {{ $weeklyFocus->end_date }} <br>
                                    <span style="font-size: 0.875rem" class="fw-normal"> There are <strong>{{ $weeklyFocus->focus_items->count() }}</strong> focuses this week</span>
                                </a>
                                <div><i class="ti ti-arrow-right"></i></div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <x-feedback-component :platinumId="auth()->user()->platinum->id" :feedback-type="\App\Enums\FeedbackTypes::FOCUS"/>
        </div>
    </div>
</x-modern-layout>
