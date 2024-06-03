<x-modern-layout title="List of Drafts">
    @vite('resources/js/draft_index.js')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-4">Drafts</h4>
            <div class="mb-2">
                <strong>First Draft Start Date:</strong> {{ $firstStartDate }}
            </div>
            <table class="table display nowrap mb-4" id="draftsTable" style="min-width: 100%">
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

            <div class="d-flex gap-2 justify-content-md-start justify-content-center">
                <a href="{{ route('draft.create') }}" class="btn btn-primary">Upload Draft</a>
            </div>
        </div>
    </div>
</x-modern-layout>
