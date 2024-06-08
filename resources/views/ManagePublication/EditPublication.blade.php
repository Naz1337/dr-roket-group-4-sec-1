<x-modern-layout>
    <div class="p-3 bg-white h-100 content">
        <div class="card shadow-sm border-0" style="background-color: #ffffff; border-radius: 10px;">
            <div class="card-body">
                <h4 class="mb-4">Publication Details</h4>
                <form action="{{ route('updatepublication', $publication->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- This method spoofing is necessary for the PUT request -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="title" class="form-label">Title:</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" value="{{ $publication->P_title }}" name="P_title" type="text" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="author" class="form-label">Authors:</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" value="{{ $publication->P_authors }}" name="P_authors" type="text" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="type" class="form-label">Publication Type:</label>
                        </div>
                        <div class="col-md-9">
                            <select class="form-control" name="P_type" id="type" required>
                                <option value="" disabled>aSelect the type</option>
                                <option value="Book" {{ $publication->P_type == 'Book' ? 'selected' : '' }}>Book</option>
                                <option value="Journal" {{ $publication->P_type == 'Journal' ? 'selected' : '' }}>Journal</option>
                                <option value="Thesis" {{ $publication->P_type == 'Thesis' ? 'selected' : '' }}>Thesis</option>
                                <option value="Methodology" {{ $publication->P_type == 'Methodology' ? 'selected' : '' }}>Methodology</option>
                                <option value="Literature" {{ $publication->P_type == 'Literature' ? 'selected' : '' }}>Literature</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="date" class="form-label">Published Date:</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" value="{{ $publication->P_published_date }}" name="P_published_date" type="date" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="volume" class="form-label">Volume:</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" value="{{ $publication->P_volume }}" name="P_volume" type="number" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="issues" class="form-label">Issues:</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" value="{{ $publication->P_issues }}" name="P_issues" type="number" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="pages" class="form-label">Pages:</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" value="{{ $publication->P_pages }}" name="P_pages" type="number" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="publisher" class="form-label">Publisher:</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" value="{{ $publication->P_publisher }}" name="P_publisher" type="text" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="doi" class="form-label">DOI:</label>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" value="{{ $publication->P_path }}" name="P_path" type="text" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="description" class="form-label">Description:</label>
                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control" name="P_description" rows="3" required>{{ $publication->P_description }}</textarea>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a href="{{ route('mypublication') }}" type="button" class="btn btn-secondary me-md-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-modern-layout>
