<x-modern-layout>
    <div class="p-3 bg-light h-100 content">
        <div class="card shadow-sm border-0" style="background-color: #ffffff; border-radius: 10px;">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Title:</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" value="{{ $publication->P_title }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Authors:</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" value="{{ $publication->P_authors }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Type:</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" value="{{ $publication->P_type }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Published Date:</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" value="{{ $publication->P_published_date }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Volume:</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" value="{{ $publication->P_volume }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Issues:</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" value="{{ $publication->P_issues }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Pages:</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" value="{{ $publication->P_pages }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Publisher:</label>
                    </div>
                    <div class="col-md-9">
                        <input class="form-control" value="{{ $publication->P_publisher }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Description:</label>
                    </div>
                    <div class="col-md-9">
                        <textarea class="form-control" rows="3" readonly>{{ $publication->P_description }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">DOI:</label>
                    </div>
                    <div class="col-md-9">
                        <a href="{{ $publication->P_path }}" target="_blank">{{ $publication->P_path }}</a>
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                <a href="{{ route($referrer) }}" type="button" class="btn btn-secondary me-md-2">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-modern-layout>
