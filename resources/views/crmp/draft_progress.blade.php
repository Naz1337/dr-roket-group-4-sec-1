<x-modern-layout title="List of Drafts">
    @vite('resources/js/draft_index.js')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-4">Drafts</h4>
            <div class="mb-2">
                <strong>First Draft Start Date:</strong> {{ $firstStartDate }}
            </div>
            <table class="table display mb-4" id="draftsTable" style="min-width: 100%">
                <thead>
                <tr>
                    <th>Draft No</th>
                    <th>Draft Title</th>
                    <th>Completion Date</th>
                    <th>Time Taken to Finish</th>
                    <th>DDC</th>
                    <th>Pages</th>
                </tr>
                </thead>
                <tbody>
                @foreach($drafts as $draft)
                    <tr data-row-link="{{ route('draft.show', ['draft' => $draft]) }}">
                        @php
                            $carbon = \Carbon\Carbon::parse($draft->draft_completion_date);
                        @endphp
                        <td>{{ $draft->draft_number }}.</td>
                        <td>{{ $draft->draft_title }}</td>
                        <td data-order="{{ $carbon->getTimestampMs() }}">{{ $carbon->format('j F Y') }}</td>
                        <td>{{ $draft->draft_days_taken }}</td>
                        <td>{{ $draft->draft_ddc }}</td>
                        <td>{{ $draft->draft_page_count }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5" class="text-end">Total Page:</th>
                    <th class="text-end"></th>
                </tr>
                </tfoot>
            </table>

            @vite('resources/js/crmp_draft_progress.js')
            <div class="d-flex gap-2 justify-content-md-start justify-content-center mb-4">
                <button class="btn btn-primary" id="modalTgl">Give Feedback</button>
            </div>

            <x-feedback-component :platinumId="$platinum->id" />

        </div>
    </div>
    <div class="modal fade" id="feedbackModals" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h1 class="modal-title fs-5">Give Feedback</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('crmp.feedback', ['type' => \App\Enums\FeedbackTypes::DRAFT, 'platinum' => $platinum]) }}"
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
