<x-modern-layout>
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
                        <input class="form form-control" value="{{ $expert->expert_domain_image }}" type="file">
                    </div>
                    <div class="row p-3">
                        <label class="form form-label">Designation:</label>
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="Prof." name="designation[]" id="designation1">
                                <label class="form-check-label" for="designation1">Prof.</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="Ir." name="designation[]" id="designation2">
                                <label class="form-check-label" for="designation2">Ir.</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="Ts." name="designation[]" id="designation3">
                                <label class="form-check-label" for="designation3">Ts.</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" value="Dr." name="designation[]" id="designation4">
                                <label class="form-check-label" for="designation4">Dr.</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row bg bg-light border-bottom border-end border-start border-1 border-black ">
                <div class="col">
                    <div class="row p-3">
                        <div class="col">
                            <label class="form form-label">Name:</label>
                            <input class="form form-control" value="{{ $expert->expert_domain_names }}" type="text">
                        </div>
                        <div class="col">
                            <label class="form form-label">Email:</label>
                            <input class="form form-control" type="email" value="{{ $expert->expert_domain_emails }}">
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col">
                            <label class="form form-label">Phone Number:</label>
                            <input class="form form-control" type="text" value="{{ $expert->expert_domain_phonenumbers }}">
                        </div>
                        <div class="col">
                            <label class="form form-label">Affiliation:</label>
                            <input class="form form-control" type="text" value="{{ $expert->expert_domain_affiliation }}" >
                        </div>
                    </div>
                    <div class="row p-3">
                        <label class="form form-label">Area of Expertise:</label>
                        <input class="form form-control" type="text" value="{{ $expert->expert_domain_research_title }}" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-1 p-3 d-flex justify-content-end">
                    <a href="{{ route('view-expert.id', $expert->id) }}" type="button" class="btn btn-primary">Back</a>
                </div>
                <div class="col p-3 d-flex justify-content-end">
                    <a href="#" type="submit" class="btn btn-primary">Edit Profile</a>
                </div>
                <div class="col-1 p-3 d-flex justify-content-end">
                    <a href=" {{ route('view-expert.id', $expert->id) }} " type="button" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</x-modern-layout>