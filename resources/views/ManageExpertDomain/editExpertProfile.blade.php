{{-- Image loader --}}
@section('scripts')
    <script type="module">
        $(document).ready(function () {
            //$("#imagePreview").hide();
            $("#image").on("change",function(e){
                var arrTemp = this.value.split('\\');
                document.getElementById("imagePreview").value = arrTemp[arrTemp.length - 1];
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imagePreview').attr('src', e.target.result);
                        $('#imagePreview').show();
                    }

                    reader.readAsDataURL(this.files[0]);
                    $("#imagePreview").show();
                }
            });
        })
    </script>
@stop
<x-modern-layout>
    <div class="p-3 bg-white h-100 content">
        {{-- Page Content --}}
        <form action="{{ route('update-expert.id', $expert->id) }}" method="post">
            @csrf
            <div class="row p-3 bg bg-light border-top border-end border-start border-1 border-black ">
                <div class="col-3">
                    <div class="row h-100 p-3 border border-1 border-dark">
                        {{-- Image load --}}
                        <img class="h-100 w-50" src="{{ Storage::url($expert->expert_domain_image) }}" alt="Image Uploaded" id="imagePreview">
                    </div>
                </div>
                <div class="col">
                    <div class="row p-3">
                        {{-- Upload Image --}}
                        <label class="form form-label">Upload Expert Image:</label>
                        <input class="form form-control" value="{{ $expert->expert_domain_image }}" type="file" accept="" name="ed_image" id="image">
                    </div>
                    <div class="row p-3">
                        {{-- Designation from config --}}
                        <label class="form form-label">Designation:</label>
                        <div class="col">
                            @foreach (Config::get('constants.designation') as $item)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="{{ $item }}" name="ed_designation[]" 
                                    @if (in_array($item, explode(',', $expert->expert_domain_designation)))
                                        {{"checked"}}
                                    @endif
                                    >
                                    <label class="form-check-label" for="designation">{{ $item }}</label>
                                </div>   
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row bg bg-light border-bottom border-end border-start border-1 border-black ">
                <div class="col">
                    <div class="row p-3">
                        <div class="col">
                            {{-- Expert Name --}}
                            <label class="form form-label">Name:</label>
                            <input class="form form-control" value="{{ $expert->expert_domain_names }}" type="text" name="ed_name">
                        </div>
                        <div class="col">
                            {{-- Expert Email --}}
                            <label class="form form-label">Email:</label>
                            <input class="form form-control" type="email" value="{{ $expert->expert_domain_emails }} " name="ed_email">
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col">
                            {{-- Expert Phone Number --}}
                            <label class="form form-label">Phone Number:</label>
                            <input class="form form-control" type="text" value="{{ $expert->expert_domain_phonenumbers }}" name="ed_phonenum">
                        </div>
                        <div class="col">
                            {{-- Expert Affiliation --}}
                            <label class="form form-label">Affiliation:</label>
                            <input class="form form-control" type="text" value="{{ $expert->expert_domain_affiliation }}" name="ed_affiliation">
                        </div>
                    </div>
                    <div class="row p-3">
                        {{-- Expert Area of Expertise --}}
                        <label class="form form-label">Area of Expertise:</label>
                        <input class="form form-control" type="text" value="{{ $expert->expert_domain_research_title }}" name="ed_research">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-1 p-3 d-flex justify-content-end">
                    {{-- Back button --}}
                    <a href="{{ route('view-expert.id', $expert->id) }}" type="button" class="btn btn-primary">Back</a>
                </div>
                <div class="col p-3 d-flex justify-content-end">
                    {{-- Edit Button --}}
                    <button type="submit" class="btn btn-primary">Edit Profile</button>
                </div>
                <div class="col-1 p-3 d-flex justify-content-end">
                    {{-- Cancel button --}}
                    <a href=" {{ route('view-expert.id', $expert->id) }} " type="button" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</x-modern-layout>