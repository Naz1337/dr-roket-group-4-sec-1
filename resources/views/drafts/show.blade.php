<x-modern-layout title="Draft">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Draft Details</h4>

            <!-- Draft Information -->
            <div class="mb-4">
                <h5 class="mb-2">Draft Information</h5>
                <div class="row mb-3">
                    <div class="col-md-3 col-form-label">Draft Title:</div>
                    <div class="col-md-3 ">
                        <input type="text" class="form-control-plaintext" readonly
                               value="{{ $draft->draft_title }}">
                    </div>
                    <div class="col-md-3 col-form-label">Draft Number:</div>
                    <div class="col-md-3">
                        <input type="text" class="form-control-plaintext" readonly
                        value="{{ $draft->draft_number }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 col-form-label">Completion Date:</div>
                    <div class="col-md-3">
                        @php
                        $date = new DateTime($draft->draft_completion_date);
                        @endphp
                        <input type="text" class="form-control-plaintext" readonly
                               value="{{ $date->format('j F, Y') }}">
                    </div>
                    <div class="col-md-3 col-form-label">Days Taken:</div>
                    <div class="col-md-3">
                        <input type="text" class="form-control-plaintext" readonly
                               value="{{ $draft->draft_days_taken }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3 col-form-label">Draft DDC:</div>
                    <div class="col-md-3">
                        <input type="text" class="form-control-plaintext" readonly
                               value="{{ $draft->draft_ddc }}">
                    </div>
                </div>
            </div>

            <!-- File Information -->
            <div class="mb-4">
                <h5 class="mb-2">Draft File Information</h5>
                <div class="row mb-3">
                    <div class="col-md-3 col-form-label">Filename:</div>
                    <div class="col-md-3">
                        <input type="text" class="form-control-plaintext" readonly
                               value="{{ $draft->draft_filename }}">
                    </div>
                    <div class="col-md-3 col-form-label">Submitted At:</div>
                    <div class="col-md-3">
                        @vite('resources/js/draft_show.js')
                        <input type="text" class="form-control-plaintext" readonly id="createdAt"
                               value="" data-time="{{ $draft->created_at->getPreciseTimestamp(3) }}">
                        </div>
                </div>
                <div class="row mb-3">

                </div>
            </div>

            <!-- Download Button -->
            <div class="text-center">
                <a href="[DOWNLOAD_LINK]" class="btn btn-primary">Download Draft</a>
            </div>
        </div>
    </div>


</x-modern-layout>
