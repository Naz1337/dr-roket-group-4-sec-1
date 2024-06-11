<x-modern-layout>
    {{-- Page Content --}}
    <div class="card" style="width: 18rem;">
        <div class="card-body d-flex align-items-center">
            <span class="ti ti-script" style="font-size: 2rem; margin-right: 1rem;"></span>
            <div>
                <h5 class="card-title">Total Publication:</h5>
                <p class="card-text">{{ $totalPublications }}</p>
            </div>
        </div>
    </div>

    {{-- Search Bar --}}
    <form id="search-form" action="{{ route('search') }}" method="GET">
        <!-- Search Form -->
        <div class="row">
            <div class="col-1">
                <label class="form-label p-2">Search:</label>
            </div>
            <div class="col">
                <input id="search-query" name="search-query" class="form-control" type="text" placeholder="Search by title or author...">
            </div>
            <div class="col-2">
                <select name="search-year" id="search-year" class="form-select">
                    <option value="">Any Year</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ request('search-year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2 d-flex justify-content-end mb-4">
                <button type="submit" class="btn btn-primary text-decoration-none">Search</button>
            </div>
        </div>
    </form>
    <hr>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col d-flex justify-content-start ">
                        <h1>My Publication</h1>
                    </div>
                    <div class="col d-flex justify-content-end mb-4">
                        <a href="{{ route('addpublication') }}" class="btn btn-primary">Create New Publication</a>
                    </div>
                </div>
                <hr>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Type</th>
                            <th scope="col">Published Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($publications as $publication)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $publication->P_title }}</td>
                            <td>{{ $publication->P_authors }}</td>
                            <td>{{ $publication->P_type }}</td>
                            <td>{{ $publication->P_published_date }}</td>
                            <td>
                                <div class="d-flex" role="group">
                                    <a href="{{ route('viewpublication', ['id' => $publication->id, 'referrer' => 'mypublication']) }}" class="btn btn-primary btn-sm me-1">View</a>
                                    <button class="btn btn-warning btn-sm me-1" onclick="window.location='{{ route('editpublication', $publication->id) }}'">Edit</button>
                                    <form action="{{ route('deletepublication', $publication->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No publications found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-modern-layout>
