<x-modern-layout title="Draft">
    @vite('resources/js/draft_edit.js')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('draft.update', ['draft' => $draft]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <h4 class="card-title mb-4">Draft Details</h4>

                <!-- Draft Information -->
                <div class="mb-4">
                    <h5 class="mb-3">Draft Information</h5>
                    <div class="row mb-2">
                        <div class="col-md-3 col-form-label">Draft Title:</div>
                        <div class="col-md-3 ">
                            <input type="text" class="form-control" name="draft_title"
                                   title="{{ $draft->draft_title }}"  value="{{ $draft->draft_title }}">
                        </div>
                        <div class="col-md-3 col-form-label">Draft Number:</div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" readonly disabled
                            value="{{ $draft->draft_number }}">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-3 col-form-label">Completion Date:</div>
                        <div class="col-md-3">
                            <input type="date" class="form-control" max="{{ $maxDate }}" min="{{ $minDate }}"
                                   value="{{ $draft->draft_completion_date }}" id="draftDate"
                                   name="draft_completion_date">
                        </div>
                        <div class="col-md-3 col-form-label">Days Taken:</div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" min="0" max="{{ $maxDaysTaken }}"
                                   value="{{ $draft->draft_days_taken }}" id="daysTaken" name="draft_days_taken">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-form-label">Draft DDC:</div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="number" class="form-control" name="draft_ddc"
                                       value="{{ $draft->draft_ddc }}">
                                <span class="input-group-text">/100</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- File Information -->
                <div class="mb-4">
                    <h5 class="mb-3">Draft File Information</h5>
                    <div class="row mb-2">
                        <div class="col-md-3 col-form-label"> Current File:</div>
                        <div class="col-md-9">
                            <input type="text" class="form-control-plaintext"
                                   value="{{ $draft->draft_filename }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="draftFile" class="form-label">Upload Draft</label>
                            <div id="dropArea" class="drag-drop-area">
                                Replace the current file by dragging and dropping a new file here or clicking to select a file.
                            </div>
                            <input type="file" id="draftFile" class="form-control d-none @error('draft_file') is-invalid @enderror " accept=".pdf, .txt" name="draft_file">
                            @error('draft_file')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Download Button -->
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('draft.show', ['draft' => $draft]) }}" class="btn btn-outline-secondary">Back</a>
                    <button type="reset" class="btn btn-outline-secondary" id="formReset">Reset File</button>
                    <button type="submit" class="btn btn-primary">Submit Edit</button>
                </div>
            </form>
            {{-- print all errors --}}
            @if ($errors->any())
                <div class="alert alert-danger mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>


</x-modern-layout>
