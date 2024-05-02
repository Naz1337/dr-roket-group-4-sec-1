<x-app-layout>
    <div class="p-3 bg-white h-100 content">
        {{-- Page Content --}}
        <div class="row">
            <div class="col">
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
                    <div class="col-1">
                        <a href="#" type="submit" class="btn btn-primary text-decoration-none">Search</a>
                    </div>
                    <div class="col-2">
                        <a href="{{ route('addprofile') }}" class="btn btn-primary text-decoration-none">Add Profile</a>
                    </div>
                    <div class="col-1">
                        <a href="#" class="btn btn-info text-white text-decoration-none">Report</a>
                    </div>
                </div>
            </div>
            
        </div>
        <hr>
        <div class="row p-3 bg bg-light">
            {{-- Expert Profile --}}
            @for ($i = 0; $i < 5; $i++)
                <div class="row p-3 m-1 border border-1 border-dark">
                    <div class="col-2 p-2">
                        <img alt="Lecturer Image" src="#" style="height: 100px; width: 100px;">
                    </div>
                    <div class="col p-2">
                        <p>
                            Name: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tincidunt gravida odio iaculis laoreet.
                        </p>
                        <p>
                            Current Institution: Lorem ipsum dolor sit amet
                        </p>
                        <p>
                            Email: Lorem ipsum dolor sit amet
                        </p>
                    </div>
                    <div class="col-1 p-2">
                        <a class="btn btn-primary text-decoration-none">
                            View
                        </a>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</x-app-layout>