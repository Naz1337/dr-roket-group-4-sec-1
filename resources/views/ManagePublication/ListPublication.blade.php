<x-modern-layout>
    <div class="p-3 bg-white content">
        <h2>Search Other People's Publications</h2>
        <form id="search-form" action="{{ route('searchpublication') }}" method="GET">
            <!-- Search Form -->
            <div class="row">
                <div class="col-1">
                    <label class="form-label p-2">Search:</label>
                </div>
                <div class="col">
                    <input id="search-query" name="search-query" class="form-control" type="text" placeholder="Search by title or author...">
                </div>
                <div class="col-2">
                    <input id="search-year" name="search-year" class="form-control" type="number" placeholder="Filter by year...">
                </div>
                <div class="col-2 d-flex justify-content-end mb-4">
                    <button type="submit" class="btn btn-primary text-decoration-none">Search</button>
                </div>
            </div>
        </form>

        <hr>

        <!-- Display Search Results -->
        <div id="publications-list" class="row">
            <!-- Search results will be populated here -->
            @if($publications->count() > 0)
                @foreach($publications as $publication)
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title mb-0">{{ $publication->P_title }}</h5>
                                    <a href="{{ route('viewpublication', ['id' => $publication->id, 'referrer' => 'searchpublication']) }}" class="btn btn-primary">View</a>
                                </div>
                                <p class="card-text">Authors: {{ $publication->P_authors }}</p>
                                <p class="card-text">Published Date: {{ $publication->P_published_date }}</p>
                                <!-- Truncate the description to 100 characters -->
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($publication->P_description, 100, $end='...') }}</p>
                                <!-- Add other publication details here -->
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <p>No publications found.</p>
                </div>
            @endif
        </div>
    </div>

</x-modern-layout>
