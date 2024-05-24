<x-modern-layout title="Register">
    <div
        class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <a href="#" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="{{ asset('logo.png') }}" width="180" alt="">
                            </a>
                            <p class="text-center">Register Staff</p>
                            <form action="{{ route('register-post') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input class="form-control @error('username') is-invalid @enderror"
                                           type="text" name="username" id="username" placeholder="Username"
                                           value="{{ old('username') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input class="form-control @error('email') is-invalid @enderror"
                                           type="text" name="email" id="email" placeholder="Email"
                                           value="{{ old('email') }}">
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror"
                                           type="password" name="password" id="password" placeholder="Password">
                                </div>
                                <div class="mb-4">
                                    <label for="image" class="form-label">Image</label>
                                    <div class="input-group mb-1">
                                        <input type="file" name="image" id="image" class="form-control" accept="image/png, image/jpeg">
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
                                    <div class="text-center">
                                        <img id="imagePreview" src="#" alt="Image" width="100" />
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign Up</button>
                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                                    <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Sign In</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-modern-layout>
