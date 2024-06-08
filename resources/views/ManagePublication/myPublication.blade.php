<x-modern-layout>
        {{-- Page Content --}}
        <div class="card" style="width: 18rem;">
        <div class="card-body d-flex align-items-center">
            <div>
                <h5 class="card-title">Total Publication:</h5>
                <p class="card-text">{{ $totalPublications }}</p>
            </div>
        </div>
    </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <div class="row">
                        <div class="col d-flex justify-content-start ">
                        <h1 >My Publication</h1>
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
                                        <a href="{{ route('viewpublication', ['id' => $publication->id, 'referrer' => 'mypublication']) }}">View</a>
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
                                    <td colspan="5">No publications found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-modern-layout>
