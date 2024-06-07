<x-modern-layout>
<div class="p-3 bg-white content">
{{-- Page Content --}}
    <div class="row">   
        <div class="col-1">
            <label class="form form-label p-2">Search:</label>
        </div>
        <div class="col">
            <input class="form form-control" list="datalistOptions" type="text" placeholder="Search...">
            <datalist id="datalistOptions">
                <option value="Software Security">
                <option value="Robotics">
                <option value="Pattern Recognition">
                <option value="Bio-technology">
                <option value="Cloud Architecture">
            </datalist>
        </div>
        <div class="col-2 d-flex justify-content-end mb-4">
            <i class="bi bi-search"></i>
            &nbsp;
            <a href="#" type="submit" class="btn btn-primary text-decoration-none">Search</a>
        </div>        
    </div>

    <hr>

    <div class="row p-3 bg bg-light">
    <div class="row">
        <div class="col d-flex justify-content-end mb-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Create New Publication</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Title</th>
                                <th scope="col">Author</th>
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
                                <td>{{ $publication->P_published_date }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $publication->id }}">Edit</button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $publication->id }}">Delete</button>
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

        <!-- Create Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Create New Publication</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('publications.store') }}" method="POST">
                            @csrf
                            <!-- Form fields for creating a new publication -->
                            <div class="row p-3">
                                <label class="form-label">Publication Type:</label>
                                <div class="col">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="Book" name="P_type[]" id="designation1">
                                        <label class="form-check-label" for="designation1">Book</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="Article" name="P_type[]" id="designation2">
                                        <label class="form-check-label" for="designation2">Article</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="Ts." name="P_type[]" id="designation3">
                                        <label class="form-check-label" for="designation3">Ts.</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" value="Dr." name="P_type[]" id="designation4">
                                        <label class="form-check-label" for="designation4">Dr.</label>
                                    </div>
                                </div>
                            </div> 
                            <div class="col">
                                <div class="row p-3">
                                    <div class="col">
                                        <label for="title" class="form-label">Title:</label>
                                        <input class="form-control" placeholder="Publication Title" type="text"  name="P_title" id="title"  required>
                                    </div>
                                    <div class="col">
                                        <label for="author" class="form-label">Authors:</label>
                                        <input class="form-control" placeholder="Author's Name" type="text" name="P_authors" id="author" required>
                                    </div>
                                </div>
                                <div class="row p-3">
                                    <div class="col">
                                        <label for="date" class="form-label">Published Date:</label>
                                        <input class="form-control" placeholder="Published Date" type="date" name="P_published_date" id="date" required>
                                    </div>
                                    <div class="col">
                                        <label for="volume" class="form-label">Volume:</label>
                                        <input class="form-control" placeholder="Publication's Volume" type="number" name="P_volume" id="volume"  required>
                                    </div>
                                </div>
                                <div class="row p-3">
                                    <div class="col">
                                        <label for="issues" class="form-label">Issues:</label>
                                        <input class="form-control" placeholder="Publication's Issues" type="number" name="P_issues" id="issues"  required>
                                    </div>
                                    <div class="col">
                                        <label for="pages" class="form-label">Pages:</label>
                                        <input class="form-control" placeholder="Number Of Pages" type="number" name="P_pages" id="pages"  required>
                                    </div>
                                </div>
                                <div class="row p-3">
                                    <div class="col">
                                        <label for="publisher" class="form-label">Publisher:</label>
                                        <input class="form-control" placeholder="Publisher's Name" type="text" name="P_publisher" id="publisher"  required>
                                    </div>
                                    <div class="col">
                                        <label for="description" class="form-label">Description:</label>
                                        <input class="form-control" placeholder="Publication's Description" type="text" name="P_description" id="description"  required>
                                    </div>
                                </div>
                                <div class="row p-3">
                                    <div class="col">
                                        <label for="link" class="form-label">DOI:</label>
                                        <input class="form-control" placeholder="Publication DOI" type="text" name="P_path" id="link"  required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-modern-layout>
