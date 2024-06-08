<x-modern-layout>
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
                    <div class="col-2">
                        <i class="bi bi-search"></i>
                        &nbsp;
                        <a href="#" type="submit" class="btn btn-primary text-decoration-none">Search</a>
                    </div>
                    <div class="col-2">
                        <a href="{{ route('addprofile') }}" class="btn btn-primary text-decoration-none"><i class="bi bi-rocket"></i> &nbsp; Add Profile</a>
                    </div>
                    <div class="col-1">
                        <a href=" {{ route('generatereport') }}" class="btn btn-info text-white text-decoration-none">Report</a>
                    </div>
                </div>
            </div>
            
        </div>
        <hr>
        <div class="row p-3 bg bg-light">
            {{-- Expert Profile --}}
            @foreach ($myexperts as $expert)
                <div class="row p-3 m-1 border border-1 border-dark">
                    <div class="col-2 p-2">
                        <img alt="Lecturer Image" src="{{ Storage::url($expert->expert_domain_image) }}" class="h-100 w-100">
                    </div>
                    <div class="col p-2">
                        <p>
                            Name: {{ $expert->expert_domain_names }}
                        </p>
                        <p>
                            Current Institution: {{ $expert->expert_domain_affiliation }}
                        </p>
                        <p>
                            Email: {{ $expert->expert_domain_emails }}
                        </p>
                    </div>
                    <div class="col-1 p-2">
                        <a href=" {{ route('view-expert.id', $expert->id) }} " class="btn btn-primary text-decoration-none">
                            View
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-modern-layout>