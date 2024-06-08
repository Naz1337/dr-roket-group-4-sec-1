<x-modern-layout>
    <div class="p-3 bg-white h-100 content">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-4">Publication Details</h4>
                <form action="{{ route('savepublication') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row p-3">
                        <div class="col">
                            <label for="title" class="form-label">Title:</label>
                            <input class="form-control" placeholder="Publication Title" type="text" name="P_title" id="title" required>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col">
                            <label for="author" class="form-label">Authors:</label>
                            <input class="form-control" placeholder="Author's Name" type="text" name="P_authors" id="author" required>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col">
                            <label for="type" class="form-label">Publication Type:</label>
                            <select class="form-control" name="P_type" id="type" required>
                                <option value="" disabled selected>Select the type</option>
                                <option value="Book">Book</option>
                                <option value="Journal">Journal</option>
                                <option value="Thesis">Thesis</option>
                                <option value="Methodology">Methodology</option>
                                <option value="Literature">Literature</option>
                            </select>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col">
                            <label for="date" class="form-label">Published Date:</label>
                            <input class="form-control" placeholder="Published Date" type="date" name="P_published_date" id="date" required>
                        </div>
                        <div class="col">
                            <label for="volume" class="form-label">Volume:</label>
                            <input class="form-control" placeholder="Publication's Volume" type="number" name="P_volume" id="volume" required>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col">
                            <label for="issues" class="form-label">Issues:</label>
                            <input class="form-control" placeholder="Publication's Issues" type="number" name="P_issues" id="issues" required>
                        </div>
                        <div class="col">
                            <label for="pages" class="form-label">Pages:</label>
                            <input class="form-control" placeholder="Number Of Pages" type="number" name="P_pages" id="pages" required>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col">
                            <label for="publisher" class="form-label">Publisher:</label>
                            <input class="form-control" placeholder="Publisher's Name" type="text" name="P_publisher" id="publisher" required>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col">
                            <label for="link" class="form-label">DOI:</label>
                            <input class="form-control" placeholder="Publication DOI" type="text" name="P_path" id="link" required>
                        </div>
                    </div>
                   
                    <div class="row p-3">
                        <div class="col">
                            <label for="description" class="form-label">Description:</label>
                            <textarea class="form-control" placeholder="Publication's Description" name="P_description" id="description" rows="3" required></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col p-3 d-flex justify-content-start">
                            <a href="{{ route('mypublication') }}" type="button" class="btn btn-danger me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Add Publication</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

 
</x-modern-layout>
