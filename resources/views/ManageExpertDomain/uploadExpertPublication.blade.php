<x-modern-layout>
    <div class="p-3 bg-white h-100 content">
        {{-- Page Content --}}
        <form action="{{ route('create-expert-publication.id', $id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row p-3 bg bg-light border-top border-bottom border-end border-start border-1 border-black ">
                <div class="col">
                    <div class="row p-3">
                        {{-- Expert Publication Title --}}
                        <label class="form form-label">Title</label>
                        <input class="form form-control" type="text" name="P_title" placeholder="Insert Title of Publication" required>
                    </div>
                    
                    <div class="row">
                        <div class="col">
                            <div class="row p-3">
                                {{-- Expert Publication Type --}}
                                <label class="form form-label">Publication Type:</label>
                                <select class="form form-control" name="P_type" required>
                                    <option selected>Please Select Publication Type</option>
                                    <option value="Books">Books</option>
                                    <option value="Journal Articles">Journal Articles</option>
                                    <option value="Conference Papers">Conference Papers</option>
                                    <option value="Theses">Theses</option>
                                    <option value="Dissertations">Dissertations</option>
                                    <option value="Reports">Reports</option>
                                    <option value="Magazines">Magazines</option>
                                    <option value="News Articles">News Articles</option>
                                    <option value="Review Articles">Review Articles</option>
                                    <option value="White Papers">White Papers</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row p-3">
                                {{-- Expert Publication Author --}}
                                <label class="form form-label">Author</label>
                                <input class="form form-control" type="text" name="P_authors" placeholder="Author Name" required>
                            </div>
                            <div class="row p-3">
                                {{-- Expert Publication Published Date --}}
                                <label class="form form-label">Published Date</label>
                                <input class="form form-control" type="date" name="P_published_date" required>
                            </div>
                            <div class="row p-3">
                                {{-- Expert Publication Issues --}}
                                <label class="form form-label">Issues</label>
                                <input class="form form-control" type="number" name="P_issues" placeholder="e.g. 4,7" required>
                            </div>
                            <div class="row p-3">
                                {{-- Expert Publication DOI --}}
                                <label class="form form-label">DOI:</label>
                                <input class="form form-control" type="text" name="P_path" placeholder="DOI number" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row p-3">
                                {{-- Expert Publication Volumes --}}
                                <label class="form form-label">Volumes</label>
                                <input class="form form-control" type="number" name="P_volume" placeholder="e.g 1, 3" required>
                            </div> 
                            <div class="row p-3">
                                {{-- Expert Publication Pages --}}
                                <label class="form form-label">Pages</label>
                                <input class="form form-control" type="number" name="P_pages" placeholder="e.g 137-144" required>
                            </div>
                            <div class="row p-3">
                                {{-- Expert Publication Publisher --}}
                                <label class="form form-label">Publisher</label>
                                <input class="form form-control" name="P_publisher" placeholder="e.g IEEE ScienceDirect" required>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row p-3">
                                {{-- Expert Publication Description --}}
                                <label class="form form-label">Description</label>
                                <textarea class="form form-control" type="text" id="description" name="P_description" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-1 p-3 d-flex justify-content-end">
                    {{-- Back Button --}}
                    <a href="{{ route('view-expert.id', $id) }}" type="button" class="btn btn-primary">Back</a>
                </div>
                <div class="col p-3 d-flex justify-content-end">
                    {{-- Add button --}}
                    <button type="submit" class="btn btn-primary">Add Publication</button>
                </div>
                <div class="col-1 p-3 d-flex justify-content-end">
                    {{-- Clear button --}}
                    <button onclick="window.location.reload(true)" type="button" class="btn btn-danger">Clear</button>
                </div>
            </div>
        </form>
    </div>
</x-modern-layout>