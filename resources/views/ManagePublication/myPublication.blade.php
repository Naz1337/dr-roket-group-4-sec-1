<x-modern-layout>
    <div class="p-3 bg-white content">
        {{-- Page Content --}}
        <div class="row">   
            <div class="col-1">
                <label class="form-label p-2">Search:</label>
            </div>
            <div class="col">
                <input class="form-control" list="datalistOptions" type="text" placeholder="Search...">
                <datalist id="datalistOptions">
                </datalist>
            </div>
            <div class="col-2 d-flex justify-content-end mb-4">
                <i class="bi bi-search"></i>
                &nbsp;
                <a href="#" class="btn btn-primary text-decoration-none">Search</a>
            </div>        
        </div>

        <hr>

        <div class="row p-3 bg-light">
            <div class="col d-flex justify-content-start ">
                <h1 >My Publication</h1>
            </div>
            <div class="col d-flex justify-content-end mb-4">
                <a href="{{ route('addpublication') }}" class="btn btn-primary">Create New Publication</a>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
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
                                        <button class="btn btn-primary btn-sm me-1" onclick="window.location='{{ route('viewpublication', $publication->id) }}'">View</button>
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
