<x-modern-layout title="Create Draft">
    @vite('resources/js/draft_form.js')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-4">Draft Form</h4>
            <form action="{{ route('draft.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Draft Title -->
                <div class="mb-3">
                    <label for="draftTitle" class="form-label">Draft Title</label>
                    <input type="text" class="form-control" id="draftTitle" name="draft_title"
                           placeholder="Enter draft title" required maxlength="255">
                </div>

                <!-- Draft Number and Draft DDC (shared row) -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="draftNumber" class="form-label">Draft Number</label>
                        <input type="text" class="form-control" id="draftNumber" name="draft_number"
                               placeholder="Draft number will be assigned by the system" readonly disabled
                               value="1">
                    </div>
                    <div class="col-md-6">
                        <label for="draftDdc" class="form-label">Draft DDC</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="draftDdc" name="draft_ddc"
                                   placeholder="Enter draft DDC" required aria-describedby="ddcHelp"
                                   min="1" max="100" value="5">
                            <span class="input-group-text">/100</span>
                        </div>
                    </div>
                </div>

                <!-- Completion Date, Number of Days Taken, and First Draft Start Date (shared row) -->
                <div class="row mb-3">
                {{-- TODO: have server insert past completion date for auto fill relevant information, could be null --}}
                    <div class="col-md-6">
                        <label for="draftCompletionDate" class="form-label">Completion Date</label>
                        <input type="date" class="form-control" id="draftCompletionDate"
                               name="draft_completion_date" required data-previous-completion-date="">
                    </div>
                    <div class="col-md-6">
                        <label for="daysTaken" class="form-label">Number of Days Taken</label>
                        <input type="number" class="form-control" id="daysTaken" name="days_taken"
                               placeholder="Enter number of days" required min="0" value="5">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="draftFile" class="form-label">Upload Draft</label>
                    <div id="dropArea" class="drag-drop-area">
                        Drag and drop your file here or click to select a file.
                    </div>
                    <input type="file" id="draftFile" class="form-control d-none" accept=".pdf, .txt" name="draft_file">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Submit Draft</button>
            </form>
            <div>
                @if ($errors->any())
                <div class="">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-modern-layout>
