<x-app-layout>
    <div class="p-3 bg-white h-100 content">
        {{-- Page Content --}}
        <form action="#" method="POST">
            <div class="row p-3 bg bg-light border-top border-end border-start border-1 border-black ">
                <div class="col-3">
                    <div class="row h-100 p-3 border border-1 border-dark">
                        <img class="h-100 w-50" src="#" alt="Image Uploaded">
                    </div>
                </div>
                <div class="col">
                    <div class="row p-3">
                        <label class="form form-label">Upload Expert Image:</label>
                        <input class="form form-control" type="file">
                    </div>
                    <div class="row p-3">
                        <label class="form form-label">Name:</label>
                        <input class="form form-control" type="text">
                    </div>
                </div>
            </div>
            <div class="row bg bg-light border-bottom border-end border-start border-1 border-black ">
                <div class="col">
                    <div class="row p-3">
                        <label class="form form-label">Email:</label>
                        <input class="form form-control" type="email">
                    </div>
                    <div class="row p-3">
                        <label class="form form-label">Phone Number:</label>
                        <input class="form form-control" type="text">
                    </div>
                    <div class="row p-3">
                        <label class="form form-label">Affiliation:</label>
                        <input class="form form-control" type="text">
                    </div>
                    <div class="row p-3">
                        <label class="form form-label">Area of Expertise:</label>
                        <input class="form form-control" type="text">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-1 p-3 d-flex justify-content-end">
                    <a href="{{ route('myexpert') }}" type="button" class="btn btn-primary">Back</a>
                </div>
                <div class="col p-3 d-flex justify-content-end">
                    <a href="#" type="submit" class="btn btn-primary">Add Profile</a>
                </div>
                <div class="col-1 p-3 d-flex justify-content-end">
                    <a href="#" type="button" class="btn btn-danger">Clear</a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>