<x-modern-layout title="{{ $platinum->plat_name }} Weekly Foci">
    @vite('resources/scss/focus_index.scss')
    <div class="card">
        <div class="card-body">
            <h3 class="mb-4">{{ $platinum->plat_name }} Weekly Focuses</h3>
            <div class="row mb-4">
                @if($platinum->user->weekly_focuses()->count() === 0)
                    <div class="col-12">
                        <div class="alert alert-info" role="alert">
                            No weekly focus yet
                        </div>
                    </div>
                @endif
                @foreach($platinum->user->weekly_focuses()->orderBy('created_at', 'desc')->get() as $weeklyFocus)
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
            @vite('resources/js/crmp_draft_progress.js')
            <div class="d-flex gap-2 justify-content-md-start justify-content-center mb-4">
                <button class="btn btn-primary" id="modalTgl">Give Feedback</button>
            </div>

            <x-feedback-component :platinumId="$platinum->id" :feedback-type="\App\Enums\FeedbackTypes::FOCUS"/>
        </div>
    </div>
    <div class="modal fade" id="feedbackModals" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h1 class="modal-title fs-5">Give Feedback</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('crmp.feedback', ['type' => \App\Enums\FeedbackTypes::FOCUS, 'platinum' => $platinum]) }}"
                      method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="feedback" class="form-label">Feedback</label>
                            <textarea name="feedback" id="feedback" class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-modern-layout>
