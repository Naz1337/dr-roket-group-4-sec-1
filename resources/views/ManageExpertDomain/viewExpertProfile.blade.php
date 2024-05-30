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
                    <img class="h-100 w-50" src="#" alt="Image Uploaded">
                </div>
            </div>
            <div class="col">
                <div class="row p-3">
                    <label class="form form-label">Expert Image:</label>
                    <input class="form form-control" type="text" value="{{ base64_encode($expert->expert_domain_image) }}" readonly>
                </div>
                <div class="row p-3">
                    <label class="form form-label">Name:</label>
                    <input class="form form-control" type="text" value="{{ $expert->expert_domain_names }}" readonly>
                </div>
            </div>
        </div>
        <div class="row bg bg-light border-bottom border-end border-start border-1 border-black ">
            <div class="col">
                <div class="row p-3">
                    <label class="form form-label">Email:</label>
                    <input class="form form-control" type="email" value="{{ $expert->expert_domain_emails }}" readonly>
                </div>
                <div class="row p-3">
                    <label class="form form-label">Phone Number:</label>
                    <input class="form form-control" type="text" value="{{ $expert->expert_domain_phonenumbers }}" readonly>
                </div>
                <div class="row p-3">
                    <label class="form form-label">Affiliation:</label>
                    <input class="form form-control" type="text" value="{{ $expert->expert_domain_affiliation }}" readonly>
                </div>
                <div class="row p-3">
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
                <a href=" {{ route('editexpert.id', $expert->id) }}" type="button" class="btn btn-primary mx-3">Edit Profile</a>
                <a href=" {{ route('deleteexpert.id', $expert->id) }}" type="button" class="btn btn-danger">Delete Profile</a>
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
                <a href=" {{ route('uploadexpertpublic') }} " class=" p-3 btn btn-primary">Upload Articles</a>
            </div>
        </div>
        <div class=" row p-3 bg bg-light border-bottom border-end border-start border-1  border-black">
            <div class="col">
                @foreach ($publications as $publication)
                    <div class="row p-3 m-3 border border-1 border-black">
                        <div class="col border border-1 border-black ">
                            <div class="row p-3 m-3">
                                <p>Title: Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Eaque laudantium error esse, perspiciatis facere commodi eum, 
                                    voluptas quia dolore quisquam sit vel maxime nostrum dolor atque
                                    officiis modi officia dolores?</p>
                            </div>
                            <div class="row p-3 m-3">
                                <p>
                                    Type: Journal
                                </p>
                            </div>
                        </div>
                        <div class="col-3 border border-1 border-black ">
                            <div class="row p-1 m-1">
                                <a class="btn btn-primary">Edit Articles</a>    
                            </div>
                            <div class="row p-1 m-1">
                                <a class="btn btn-danger">Delete Articles</a>
                            </div>
                            
                        </div>
                    </div>   
                @endforeach
            </div>
        </div>
    </div>
    {{-- Bottom Content --}}
</x-modern-layout>