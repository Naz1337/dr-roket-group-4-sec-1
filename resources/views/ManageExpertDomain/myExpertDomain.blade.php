<x-app-layout>
    <div class="d-flex w-100">
        <div class="p-2 bg-white w-100" id="stuff">
            {{-- Page Content --}}
            <div class="d-flex flex-row">
                <label class="form form-label p-2">Search:</label>
                <input class="form form-control p-2 ml-2 mr-2" type="text" placeholder="Search...">
                <a href="#" type="submit" class=" p-2 ml-2 mr-2 btn btn-primary text-decoration-none">Search</a>
                <a href="#" class=" p-2 ml-2 mr-2 btn btn-primary text-decoration-none">Add Profile</a>
                <a href="#" class="p-2 btn btn-primary text-decoration-none">Report</a>
            </div>
            <hr>
            <div class="bg bg-danger">
                {{-- Content --}}
                <p>HelloWorld</p>
            </div>
        </div>
    </div>
</x-app-layout>