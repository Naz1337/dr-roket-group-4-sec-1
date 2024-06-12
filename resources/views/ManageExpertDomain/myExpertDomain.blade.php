<x-modern-layout>
    <div class="p-3 bg-white h-100 content">
        {{-- Page Content --}}
        <div class="row">
            <div class="col">
                <form action="{{ route('my-expert') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-1">
                        <label class="form form-label p-2">Search:</label>
                    </div>
                    <div class="col">
                        <input class="form form-control" list="datalistOptions" name="search" type="text" placeholder="Search...">
                        <datalist id="datalistOptions">
                            <option value="Software Security">
                            <option value="Robotics">
                            <option value="Pattern Recognition">
                            <option value="Biotechnology">
                            <option value="Cloud Architecture">
                        </datalist>
                    </div>
                    <div class="col-2">
                        <i class="bi bi-search"></i>
                        &nbsp;
                        <button type="submit" class="btn btn-primary text-decoration-none">Search</button>
                    </div>
                    <div class="col-2">
                        <a href="{{ route('addprofile') }}" class="btn btn-primary text-decoration-none"><i class="bi bi-rocket"></i> &nbsp; Add Profile</a>
                    </div>
                    <div class="col-1">
                        <a href=" {{ route('generate-report') }}" class="btn btn-info text-white text-decoration-none">Report</a>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row p-3 bg bg-light">
            {{-- Expert Profile --}}
            @if(!$myexperts->isEmpty())
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
                                Area of Expertise: {{ $expert->expert_domain_research_title}} 
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
            @else
                <div class="row p-3 m-1 border border-1 border-dark items-center">
                    <p class="text-center">There are no expert domain data</p>
                </div>
            @endif
        </div>
    </div>
</x-modern-layout>