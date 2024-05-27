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
                        <input class="form form-control" type="file" id="image" name="image" accept="image/png, image/jpg">
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
                            <input class="form form-control" type="text" id="name" name="name">
                        </div>
                        <div class="col">
                            <label class="form form-label">Email:</label>
                            <input class="form form-control" type="email" name="email" id="email">
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col">
                            <label class="form form-label">Phone Number:</label>
                            <input class="form form-control" type="text" name="phonenum" id="phonenum">
                        </div>
                        <div class="col">
                            <label class="form form-label">Affiliation:</label>
                            <input class="form form-control" type="text" name="affiliation" id="affiliation">
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col">
                            <label class="form form-label">Area of Expertise:</label>
                            <input class="form form-control" type="text" name="research" id="research">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-1 p-3 d-flex justify-content-end">
                    <a href="{{ route('myexpert') }}" type="button" class="btn btn-primary">Back</a>
                </div>
                <div class="col p-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Add Profile</button>
                </div>
                <div class="col-1 p-3 d-flex justify-content-end">
                    <a href="#" type="button" class="btn btn-danger">Clear</a>
                </div>
            </div>
        </form>
    </div>
</x-modern-layout>