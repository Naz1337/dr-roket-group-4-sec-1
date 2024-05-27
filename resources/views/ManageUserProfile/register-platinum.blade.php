<x-modern-layout title="Add Platinum">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bolder fs-8 mb-4">Add Platinum</h5>
                <div class="card">
                    <div class="card-body">
                        {{ Form::model($user, ['route' => 'user.register_platinum']) }}
                            <h4 class="card-title fw-bolder fs-7 mb-4">Personal Info</h4>
                            <div class="row mb-3">
                                <div class="col-2 me-2">
                                    <label for="plat_title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="plat_title" name="plat_title" placeholder="eg. Dr.">
                                </div>
                                <div class="col">
                                    <label for="plat_name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="plat_name" name="plat_name" placeholder="eg. John Doe">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="plat_gender" class="form-label">Gender</label>
                                <div class="col">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="plat_gender" id="plat_gender" checked>
                                        <label class="form-check-label" for="plat_gender">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="plat_gender" id="plat_gender">
                                        <label class="form-check-label" for="plat_gender">Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col me-2">
                                    <label for="plat_photo" class="form-label">Profile Photo</label>
                                    <input type="file" class="form-control" id="plat_photo" name="plat_photo" accept="image/png,image/jpeg">
                                </div>
                                <div class="col">
                                    <img id="imagePreview" src="#" alt="Image" width="200" />
                                    @section('scripts')
                                        <script type="module">
                                            $(document).ready(function () {
                                                $("#imagePreview").hide();
                                                $("#plat_photo").on("change",function(e){
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
                            </div>
                            <div class="row mb-3">
                                <div class="col me-2">
                                    <label for="plat_religion" class="form-label">Religion</label>
                                    <input type="text" class="form-control" id="plat_religion" name="plat_religion" placeholder="eg. Muslim">
                                </div>
                                <div class="col">
                                    <label for="plat_race" class="form-label">Race</label>
                                    <input type="text" class="form-control" id="plat_race" name="plat_race" placeholder="eg. Malay">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat_citizenship" class="form-label">Citizenship</label>
                                    <input type="text" class="form-control" id="plat_citizenship" name="plat_citizenship" placeholder="Malaysia">
                                </div>
                            </div>
                            <hr>
                            <h4 class="card-title fw-bolder fs-7 mb-4">Contact Info</h4>
                            <div class="row mb-3">
                                <div class="col me-2">
                                    <label for="plat_address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="plat_address" name="plat_address" placeholder="eg. 123 Building">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat_address2" class="form-label">Address 2</label>
                                    <input type="text" class="form-control" id="plat_address2" name="plat_address2">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col me-2">
                                    <label for="plat_city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="plat_city" name="plat_city" placeholder="eg. Kota Kinabalu">
                                </div>
                                <div class="col  me-2">
                                    <label for="plat_state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="plat_state" name="plat_state" placeholder="e.g Sabah">
                                </div>
                                <div class="col">
                                    <label for="plat_postcode" class="form-label">Postcode</label>
                                    <input type="text" class="form-control" id="plat_postcode" name="plat_postcode" placeholder="eg. 88000">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col me-2">
                                    <label for="plat_phone_no" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="plat_phone_no" name="plat_phone_no" placeholder="eg. +60198829640">
                                </div>
                                <div class="col">
                                    <label for="plat_email" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="plat_email" name="plat_email" placeholder="eg. johndoe@email.com">
                                </div>
                            </div>
                            <hr>
                            <h4 class="card-title fw-bolder fs-7 mb-4">Education Info</h4>
                            <div class="row mb-3">
                                <div class="col me-2">
                                    <label for="plat_cur_edu_field" class="form-label">Current Education Field</label>
                                    <input type="text" class="form-control" id="plat_cur_edu_field" name="plat_cur_edu_field" placeholder="eg. Muslim">
                                </div>
                                <div class="col">
                                    <label for="plat_race" class="form-label">Education Field</label>
                                    <input type="text" class="form-control" id="plat_edu_field" name="plat_edu_field" placeholder="eg. Malay">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat_edu_institute" class="form-label">Education Institute</label>
                                    <input type="text" class="form-control" id="plat_edu_institute" name="plat_edu_institute" placeholder="eg. University Malaysia Pahang">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat_occupation" class="form-label">Occupation</label>
                                    <input type="text" class="form-control" id="plat_occupation" name="plat_occupation" placeholder="eg. Lecturer">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat_study_sponsor" class="form-label">Study Sponsor</label>
                                    <input type="text" class="form-control" id="plat_study_sponsor" name="plat_study_sponsor" placeholder="eg. Dr Roket">
                                </div>
                            </div>
                            <hr>
                            <h4 class="card-title fw-bolder fs-7 mb-4">Program Info</h4>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat_discover_type" class="form-label">Name</label>
                                    <select name="plat_discover_type" id="plat_discover_type" class="form-select">
                                        <option value="Friends">Friends</option>
                                        <option value="Facebook">Facebook</option>
                                        <option value="Instagram">Instagram</option>
                                        <option value="Tweeter">Tweeter</option>
                                        <option value="News">News</option>
                                        <option value="Google">Google</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="plat_prog_interest" class="form-label">Program Interested</label>
                                <div class="col">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="plat_prog_interest" id="plat_prog_interest" checked>
                                        <label class="form-check-label" for="plat_prog_interest">Platinum Professorship</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="plat_prog_interest" id="plat_prog_interest">
                                        <label class="form-check-label" for="plat_prog_interest">Platinum Premier</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="plat_prog_interest" id="plat_prog_interest">
                                        <label class="form-check-label" for="plat_prog_interest">Platinum Elite</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="plat_prog_interest" id="plat_prog_interest">
                                        <label class="form-check-label" for="plat_prog_interest">Platinum Dr. Jr.</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="plat_prog_interest" id="plat_prog_interest">
                                        <label class="form-check-label" for="plat_prog_interest">Ala Carte</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat_batch" class="form-label">Batch</label>
                                    <select name="plat_batch" id="plat_batch" class="form-select">
                                        <option value='1' >1</option>
                                        <option value='2' >2</option>
                                        <option value='3' >3</option>
                                        <option value='4.1' >4.1</option>
                                        <option value='4.2' >4.2</option>
                                        <option value='4.3' >4.3</option>
                                        <option value='5.1' >5.1</option>
                                        <option value='5.2' >5.2</option>
                                        <option value='5.3' >5.3</option>
                                        <option value='6.1' >6.1</option>
                                        <option value='6.2' >6.2</option>
                                        <option value='6.3' >6.3</option>
                                        <option value='7' >7</option>
                                        <option value='8' >8</option>
                                        <option value='9' >9</option>
                                        <option value='10' >10</option>
                                        <option value='11' >11</option>
                                        <option value='12' >12</option>
                                        <option value='13' >13</option>
                                        <option value='14' >14</option>
                                        <option value='15' >15</option>
                                        <option value='16' >16</option>
                                        <option value='16.2' >16.2</option>
                                        <option value='16.3' >16.3</option>
                                        <option value='17' >17</option>
                                        <option value='18.1' >18.1</option>
                                        <option value='18.2' >18.2</option>
                                        <option value='18.3' >18.3</option>
                                        <option value='18.4' >18.4</option>
                                        <option value='Other' >Other</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h4 class="card-title fw-semibold mb-4">Sample Input</h4>--}}
{{--                        <div class="row mb-3">--}}
{{--                            <div class="col me-2">--}}
{{--                                <label for="plat_name" class="form-label">Name</label>--}}
{{--                                <input type="text" class="form-control" id="plat_name" name="plat_name" aria-describedby="plat_name">--}}
{{--                            </div>--}}
{{--                            <div class="col">--}}
{{--                                <label for="plat_name" class="form-label">Name</label>--}}
{{--                                <input type="text" class="form-control" id="plat_name" name="plat_name" aria-describedby="plat_name">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row mb-3">--}}
{{--                            <div class="col">--}}
{{--                                <div class="form-check form-check-inline">--}}
{{--                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">--}}
{{--                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check form-check-inline">--}}
{{--                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">--}}
{{--                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row mb-3">--}}
{{--                            <div class="col">--}}
{{--                                <div class="form-check form-check-inline">--}}
{{--                                    <input type="radio" class="form-check-input" name="gender" id="exampleCheck1">--}}
{{--                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>--}}
{{--                                </div>--}}
{{--                                <div class="form-check form-check-inline">--}}
{{--                                    <input type="radio" class="form-check-input" name="gender" id="exampleCheck1">--}}
{{--                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row mb-3">--}}
{{--                            <div class="col">--}}
{{--                                <label for="plat_name" class="form-label">Name</label>--}}
{{--                                <select name="select" id="select" class="form-select">--}}
{{--                                    <option value="0">Item</option>--}}
{{--                                    <option value="0">Item</option>--}}
{{--                                    <option value="0">Item</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row mb-3">--}}
{{--                            <div class="col">--}}
{{--                                <label for="plat_name" class="form-label">Name</label>--}}
{{--                                <input type="text" class="form-control" id="plat_name" name="plat_name" aria-describedby="plat_name">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <button type="submit" class="btn btn-primary float-end">Submit</button>
            </div>
        </div>
    </div>
</x-modern-layout>
