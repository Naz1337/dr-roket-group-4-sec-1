<x-modern-layout>
    <div class="p-3 bg-white content">
        {{-- Page Content --}}
        <div class="row">
            <div class="col">
                <form action="{{ route('list-expert') }}" method="POST">
                @csrf
                <div class="row">
                    {{-- Search Bar --}}
                    <div class="col-1">
                        <label class="form form-label p-2">Search:</label>
                    </div>
                    <div class="col">
                        <input class="form form-control" list="datalistOptions" name="search" type="text" placeholder="Search...">
                        <datalist id="datalistOptions">
                            <option value="Software Security">
                            <option value="Robotics">
                            <option value="Pattern Recognition">
                            <option value="Bio-technology">
                            <option value="Cloud Architecture">
                        </datalist>
                    </div>
                    <div class="col-2">
                        <i class=" bi bi-search"></i>
                        &nbsp;
                        {{-- Search button --}}
                        <button type="submit" class="btn btn-primary text-decoration-none">Search</button>
                    </div>
                    {{-- <div class="col-2">
                        <a href="#" class="btn btn-primary text-decoration-none">Add Profile</a>
                    </div>
                    <div class="col-1">
                        <a href="#" class="btn btn-info text-white text-decoration-none">Report</a>
                    </div> --}}
                </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row p-3 bg bg-light">
            {{-- Content --}}
            @if (!$listexperts->isEmpty())
                @foreach ($listexperts as $expert)
                <div class="row p-3 m-1 border border-1 border-dark">
                    <div class="col-2 p-2">
                        <img alt="Lecturer Image" src="#" style="height: 100px; width: 100px;">
                    </div>
                    <div class="col p-2">
                        <p>
                            Name: {{ $expert->expert_domain_names }}.
                        </p>
                        <p>
                            Current Institution: {{ $expert->expert_domain_affiliation }}
                        </p>
                        <p>
                            Area of Expertise: {{ $expert->expert_domain_research_title }}
                        </p>
                        <p>
                            Email: {{ $expert->expert_domain_emails }}
                        </p>
                    </div>
                    <div class="col-1 p-2">
                        {{-- View expert profile button --}}
                        <a class="btn btn-primary text-decoration-none" href="{{ route('view-expert.id', $expert->id) }}">
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