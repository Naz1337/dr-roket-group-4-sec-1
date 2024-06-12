<x-modern-layout>
    <div class="p-3 bg-white h-100 content">
        {{-- <div class="row-1 p-2">
            <a class="btn btn-primary" href=" {{ route('') }} ">
                Back
            </a>
        </div> --}}
        {{-- Page Content --}}
        <div class="row p-3 bg bg-light border-top border-end border-start border-1 border-black ">
            <div class="col-3">
                <div class="row h-100 p-3 border border-1 border-dark">
                    {{-- Image Load --}}
                    <img id="imagePreview" class="h-100 w-50" src="{{ Storage::url($expert->expert_domain_image) }}" alt="Image Uploaded">
                </div>
            </div>
            <div class="col">
                <div class="row p-3">
                    {{-- Expert Name --}}
                    <label class="form form-label">Name:</label>
                    <input class="form form-control" type="text" value="{{ str_replace(',', ' ',$expert->expert_domain_designation) . ' ' .$expert->expert_domain_names }}" readonly>
                </div>
                <div class="row p-3">
                    {{-- Expert Email --}}
                    <label class="form form-label">Email:</label>
                    <input class="form form-control" type="email" value="{{ $expert->expert_domain_emails }}" readonly>
                </div>
            </div>
        </div>
        <div class="row bg bg-light border-bottom border-end border-start border-1 border-black ">
            <div class="col">
                <div class="row p-3">
                    {{-- Expert Phone Number --}}
                    <label class="form form-label">Phone Number:</label>
                    <input class="form form-control" type="text" value="{{ $expert->expert_domain_phonenumbers }}" readonly>
                </div>
                <div class="row p-3">
                    {{-- Expert Affiliation --}}
                    <label class="form form-label">Affiliation:</label>
                    <input class="form form-control" type="text" value="{{ $expert->expert_domain_affiliation }}" readonly>
                </div>
                <div class="row p-3">
                    {{-- Expert Area of Expertise --}}
                    <label class="form form-label">Area of Expertise:</label>
                    <input class="form form-control" type="text" value="{{ $expert->expert_domain_research_title }}" readonly>
                </div>
            </div>
        </div>
        <div class="row">
            
            {{-- <div class="col p-3 d-flex justify-content-end">
                <a href="#" type="submit" class="btn btn-primary">Edit Profile</a>
            </div> --}}
            <div class="col p-3 ">

            </div>
            <div class="col-3 p-3 d-flex justify-content-end">
                {{-- Condition button if platinum owns this expert --}}
                @if($expert->platinum->id == Auth::user()->getPlatinum()->id)
                    {{-- Edit Expert Button --}}
                    <a href=" {{ route('edit-expert.id', $expert->id) }}" type="button" class="btn btn-primary mx-3">Edit Profile</a>
                    {{-- Delete Expert Button --}}
                    <a href="{{ route('delete-expert.id', $expert->id) }}" onclick="return confirm('Are you sure?')" type="button" class="btn btn-danger">Delete Profile</a>
                @else

                @endif
            </div>
        </div>

        <div class="row p-3 bg bg-light border-top border-end border-start border-1 border-black">
            <div class="col-2 p-3">
                <h2 class="p-3">Articles</h2>
            </div>
            <div class="col p-3">
                {{-- An empty box --}}
            </div>
            <div class="p-3 col col-3 col-sm-3 col-md-2 col-lg-2 col-xl-2">
                {{-- Condition if platinum own this expert --}}
                @if($expert->platinum->id == Auth::user()->getPlatinum()->id)
                    {{-- Upload Articles button --}}
                    <a href=" {{ route('upload-expert-publication.id', $expert->id) }} " class=" p-3 btn btn-primary">Upload Articles</a>
                @else

                @endif
            </div>
        </div>
        <div class=" row p-3 bg bg-light border-bottom border-end border-start border-1  border-black">
            <div class="col">
                @if (!$publications->isEmpty())
                    @foreach ($publications as $publication)
                        <div class="row p-3 m-3 border border-1 border-black">
                            <div class="col border border-1 border-black ">
                                <div class="row p-1">
                                    <p>Title: {{ $publication->P_title }}</p>
                                </div>
                                <div class="row p-1">
                                    <p>Published Date: {{$publication->P_published_date}}</p>
                                </div>
                                <div class="row p-1">
                                    <p>
                                        Type: {{ $publication->P_type }}
                                    </p>
                                </div>
                            </div>

                            @if($expert->platinum->id == Auth::user()->getPlatinum()->id)
                                <div class="col-3 border border-1 border-black ">    
                                    <div class="row p-1 m-1">
                                        {{-- Edit Expert Publication Button --}}
                                        <a href="{{ route('edit-expert-publication.id', $publication->id) }}" type="button" class="btn btn-primary">Edit Articles</a>    
                                    </div>
                                    <div class="row p-1 m-1">
                                        {{-- Delete Expert Publication Button --}}
                                        <a href="{{ route('delete-expert-publication.id', $publication->id) }}" onclick="return confirm('Are you sure?')" type="button"  class="btn btn-danger">Delete Articles</a>
                                    </div>
                                </div>
                            @else
                            @endif
                        </div>   
                    @endforeach
                @else
                    <div class="row p-3 m-3 border border-1 border-black">
                        <div class="col border border-1 border-black">
                            <div class="row p-3 m-3">
                                <p>There are no publications</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    {{-- Bottom Content --}}
</x-modern-layout>