<x-modern-layout>
    <div class="p-3 bg-white h-100 content">
        {{-- Page Content --}}
        <form action="{{ route('createprofile') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row p-3 bg bg-light border-top border-end border-start border-1 border-black ">
                <div class="col-2">
                    <div class="row h-100 w-100 border border-1 border-dark">
                        <img id="imagePreview" class="h-100 w-100" src="#" alt="Image Uploaded">
                    </div>
                </div>
                <div class="col">
                    <div class="row p-3">
                        <label class="form form-label">Upload Expert Image:</label>
                        <input class="form form-control" type="file" id="image" name="ed_image" accept="image/png, image/jpg">
                        @section('scripts')
                            <script type="module">
                                $(document).ready(function () {
                                    $("#imagePreview").hide();
                                    $("#image").on("change",function(e){
                                        var arrTemp = this.value.split('\\');
                                        document.getElementById("imagePreview").value = arrTemp[arrTemp.length - 1];
                                        let idImgShow = 'imagePreview';
                                        if (this.files && this.files[0]) {
                                            var reader = new FileReader();
                                            reader.onload = function (e) {
                                                $('#' + idImgShow + '').attr('src', e.target.result);
                                                $('#' + idImgShow + '').show();
                                            }

                                            reader.readAsDataURL(this.files[0]);
                                            $("#imagePreview").show();
                                        }
                                    })
                                })
                            </script>
                        @stop
                    </div>
                    <div class="row p-3">
                        <label class="form form-label">Designation:</label>
                        <div class="col">
                            @foreach (Config::get('constants.designation') as $item)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="{{ $item }}" name="ed_designation[]" >
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
                            <label class="form form-label">Name:</label>
                            <input class="form form-control" type="text" name="ed_name" id="name">
                        </div>
                        <div class="col">
                            <label class="form form-label">Email:</label>
                            <input class="form form-control" type="email" name="ed_email" id="email">
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col">
                            <label class="form form-label">Phone Number:</label>
                            <input class="form form-control" type="text" name="ed_phonenum" id="phonenum">
                        </div>
                        <div class="col">
                            <label class="form form-label">Affiliation:</label>
                            <input class="form form-control" type="text" name="ed_affiliation" id="affiliation">
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col">
                            <label class="form form-label">Area of Expertise:</label>
                            <input class="form form-control" type="text" name="ed_research" id="research">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-1 p-3 d-flex justify-content-end">
                    <a href="{{ route('my-expert') }}" type="button" class="btn btn-primary">Back</a>
                </div>
                <div class="col p-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Add Profile</button>
                </div>
                <div class="col-1 p-3 d-flex justify-content-end">
                    <button onclick="window.location.reload(true)" type="button" class="btn btn-danger">Clear</button>
                </div>
            </div>
        </form>
    </div>
</x-modern-layout>