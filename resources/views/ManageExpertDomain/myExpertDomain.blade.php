<x-app-layout>
    <div class="p-3 bg-white content">
        {{-- Page Content --}}
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col-1">
                        <label class="form form-label p-2">Search:</label>
                    </div>
                    <div class="col">
                        <input class="form form-control" type="text" placeholder="Search...">
                    </div>
                    <div class="col-1">
                        <a href="#" type="submit" class="btn btn-primary text-decoration-none">Search</a>
                    </div>
                    <div class="col-2">
                        <a href="#" class="btn btn-primary text-decoration-none">Add Profile</a>
                    </div>
                    <div class="col-1">
                        <a href="#" class="btn btn-info text-white text-decoration-none">Report</a>
                    </div>
                </div>
            </div>
            
        </div>
        <hr>
        <div class="row bg bg-danger">
            {{-- Content --}}
            <p>HelloWorld</p>
        </div>
    </div>
</x-app-layout>