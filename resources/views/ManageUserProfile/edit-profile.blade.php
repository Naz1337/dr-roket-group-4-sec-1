@section('scripts')
    <script type="module">
        $(document).ready(function () {
            //$("#imagePreview").hide();
            $('#other_discover').hide();
            $("#referralInfo").hide();
            $("#{{ in_array($user->user_type, Config::get('constants.user.platOrCRMP')) ? "plat_photo" : "user_photo" }}").on("change",function(e){
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
            $("#plat_discover_type").on('change',function (e) {
                if (this.value === 'Others') {
                    $('#other_discover').show();
                }
                else {
                    $('#other_discover').hide();
                }
            });
            $("input[type=radio][name=plat_has_referral]").on('change', function () {
                if (this.value === '1') {
                    $("#referralInfo").show();
                }
                else {
                    $("#referralInfo").hide();
                }
            });
            @if(in_array($user->user_type, Config::get('constants.user.platOrCRMP')))
                $('#plat_country option[value="{{ old('plat_country') ?? $user->platinum->plat_country }}"]').prop('selected', true);
            @endif
        })
    </script>
@stop
<x-modern-layout title="Edit User Profile">
    <div class="container-fluid">
        @if(session('error'))
            <div class="alert alert-{{ session('error-type') ? session('error-type') : 'warning' }} alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bolder fs-8 mb-4">Edit User Profile</h5>
                <form action="{{ route('edit-profile-post') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="hidden" name="user_type" value="{{ $user->user_type }}">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title fw-bolder fs-7 mb-4">Personal Info</h4>
                            @if(in_array($user->user_type, Config::get('constants.user.platOrCRMP')))
                                <div class="row mb-3">
                                    <div class="col-2 me-2">
                                        <label for="plat_title" class="form-label">Title</label>
                                        <input type="text" class="form-control @error('plat_title') is-invalid @enderror" id="plat_title" name="plat_title"
                                               placeholder="eg. Dr." value="{{ old('plat_title') ?? $user->platinum->plat_title }}">
                                    </div>
                                    <div class="col">
                                        <label for="plat_name" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('plat_name') is-invalid @enderror" id="plat_name" name="plat_name"
                                               placeholder="eg. John Doe" value="{{ old('plat_name') ?? $user->platinum->plat_name }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="plat_ic" class="form-label">Identity Card No.</label>
                                        <input type="text" class="form-control @error('plat_ic') is-invalid @enderror" id="plat_ic" name="plat_ic"
                                               placeholder="eg. 020304123256" value="{{ old('plat_ic') ?? $user->platinum->plat_ic }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="plat_gender" class="form-label @error('plat_gender') text-danger @enderror">Gender</label>
                                    <div class="col">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="plat_gender" id="plat_gender" value="0" {{ $user->platinum->plat_gender == 0 ? "checked" : ""}}>
                                            <label class="form-check-label" for="plat_gender">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="plat_gender" id="plat_gender" value="1" {{ $user->platinum->plat_gender == 1 ? "checked" : ""}}>
                                            <label class="form-check-label" for="plat_gender">Female</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col me-2">
                                        <label for="plat_photo" class="form-label">Profile Photo</label>
                                        <input type="file" class="form-control @error('plat_photo') is-invalid @enderror" id="plat_photo" name="plat_photo" accept="image/png,image/jpeg">
                                    </div>
                                    <div class="col">
                                        <img id="imagePreview" src="{{ Storage::url($user->platinum->plat_photo) }}" alt="Image" width="200" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col me-2">
                                        <label for="plat_religion" class="form-label">Religion</label>
                                        <input type="text" class="form-control @error('plat_religion') is-invalid @enderror" id="plat_religion" name="plat_religion"
                                               placeholder="eg. Muslim" value="{{ old('plat_religion') ?? $user->platinum->plat_religion }}">
                                    </div>
                                    <div class="col">
                                        <label for="plat_race" class="form-label">Race</label>
                                        <input type="text" class="form-control @error('plat_race') is-invalid @enderror" id="plat_race" name="plat_race"
                                               placeholder="eg. Malay" value="{{ old('plat_race') ?? $user->platinum->plat_race }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="plat_citizenship" class="form-label">Citizenship</label>
                                        <input type="text" class="form-control @error('plat_citizenship') is-invalid @enderror" id="plat_citizenship" name="plat_citizenship"
                                               placeholder="Malaysian" value="{{ old('plat_citizenship') ?? $user->platinum->plat_citizenship }}">
                                    </div>
                                </div>
                                <hr>
                                <h4 class="card-title fw-bolder fs-7 mb-4">Contact Info</h4>
                                <div class="row mb-3">
                                    <div class="col me-2">
                                        <label for="plat_address" class="form-label">Address</label>
                                        <input type="text" class="form-control @error('plat_address') is-invalid @enderror" id="plat_address" name="plat_address"
                                               placeholder="eg. 123 Building" value="{{ old('plat_address') ?? $user->platinum->plat_address }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="plat_address2" class="form-label">Address 2</label>
                                        <input type="text" class="form-control @error('plat_address2') is-invalid @enderror" id="plat_address2" name="plat_address2"
                                               value="{{ old('plat_address2') ?? $user->platinum->plat_address2 }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col me-2">
                                        <label for="plat_city" class="form-label">City</label>
                                        <input type="text" class="form-control @error('plat_city') is-invalid @enderror" id="plat_city" name="plat_city"
                                               placeholder="eg. Kota Kinabalu" value="{{ old('plat_city') ?? $user->platinum->plat_city }}">
                                    </div>
                                    <div class="col  me-2">
                                        <label for="plat_state" class="form-label">State</label>
                                        <input type="text" class="form-control @error('plat_state') is-invalid @enderror" id="plat_state" name="plat_state"
                                               placeholder="e.g Sabah" value="{{ old('plat_state') ?? $user->platinum->plat_state }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col me-2">
                                        <label for="plat_postcode" class="form-label">Postcode/ ZIP Code/ Postal Code</label>
                                        <input type="text" class="form-control @error('plat_postcode') is-invalid @enderror" id="plat_postcode" name="plat_postcode"
                                               placeholder="e.g 88000" value="{{ old('plat_postcode') ?? $user->platinum->plat_postcode }}">
                                    </div>
                                    <div class="col">
                                        <label for="plat_country" class="form-label @error('plat_country') text-danger @enderror">Country</label>
                                        <select name="plat_country" id="plat_country" class="form-select">
                                            <!-- #region options -->
                                            <option value='Afghanistan' >Afghanistan</option><option value='Albania' >Albania</option>
                                            <option value='Algeria' >Algeria</option><option value='American Samoa' >American Samoa</option>
                                            <option value='Andorra' >Andorra</option><option value='Angola' >Angola</option>
                                            <option value='Anguilla' >Anguilla</option><option value='Antarctica' >Antarctica</option>
                                            <option value='Antigua and Barbuda' >Antigua and Barbuda</option><option value='Argentina' >Argentina</option>
                                            <option value='Armenia' >Armenia</option><option value='Aruba' >Aruba</option>
                                            <option value='Australia' >Australia</option><option value='Austria' >Austria</option>
                                            <option value='Azerbaijan' >Azerbaijan</option><option value='Bahamas' >Bahamas</option>
                                            <option value='Bahrain' >Bahrain</option><option value='Bangladesh' >Bangladesh</option>
                                            <option value='Barbados' >Barbados</option><option value='Belarus' >Belarus</option>
                                            <option value='Belgium' >Belgium</option><option value='Belize' >Belize</option>
                                            <option value='Benin' >Benin</option><option value='Bermuda' >Bermuda</option>
                                            <option value='Bhutan' >Bhutan</option><option value='Bolivia' >Bolivia</option>
                                            <option value='Bonaire, Sint Eustatius and Saba' >Bonaire, Sint Eustatius and Saba</option>
                                            <option value='Bosnia and Herzegovina' >Bosnia and Herzegovina</option><option value='Botswana' >Botswana</option>
                                            <option value='Bouvet Island' >Bouvet Island</option><option value='Brazil' >Brazil</option>
                                            <option value='British Indian Ocean Territory' >British Indian Ocean Territory</option>
                                            <option value='Brunei Darussalam' >Brunei Darussalam</option><option value='Bulgaria' >Bulgaria</option>
                                            <option value='Burkina Faso' >Burkina Faso</option><option value='Burundi' >Burundi</option>
                                            <option value='Cabo Verde' >Cabo Verde</option><option value='Cambodia' >Cambodia</option>
                                            <option value='Cameroon' >Cameroon</option><option value='Canada' >Canada</option>
                                            <option value='Cayman Islands' >Cayman Islands</option>
                                            <option value='Central African Republic' >Central African Republic</option>
                                            <option value='Chad' >Chad</option><option value='Chile' >Chile</option><option value='China' >China</option>
                                            <option value='Christmas Island' >Christmas Island</option><option value='Cocos Islands' >Cocos Islands</option>
                                            <option value='Colombia' >Colombia</option><option value='Comoros' >Comoros</option>
                                            <option value='Congo' >Congo</option>
                                            <option value='Congo, Democratic Republic of the' >Congo, Democratic Republic of the</option>
                                            <option value='Cook Islands' >Cook Islands</option><option value='Costa Rica' >Costa Rica</option>
                                            <option value='Croatia' >Croatia</option><option value='Cuba' >Cuba</option><option value='Curaçao' >Curaçao</option>
                                            <option value='Cyprus' >Cyprus</option><option value='Czechia' >Czechia</option>
                                            <option value='Côte d&#039;Ivoire' >Côte d&#039;Ivoire</option><option value='Denmark' >Denmark</option>
                                            <option value='Djibouti' >Djibouti</option><option value='Dominica' >Dominica</option>
                                            <option value='Dominican Republic' >Dominican Republic</option><option value='Ecuador' >Ecuador</option>
                                            <option value='Egypt' >Egypt</option><option value='El Salvador' >El Salvador</option>
                                            <option value='Equatorial Guinea' >Equatorial Guinea</option><option value='Eritrea' >Eritrea</option>
                                            <option value='Estonia' >Estonia</option><option value='Eswatini' >Eswatini</option>
                                            <option value='Ethiopia' >Ethiopia</option><option value='Falkland Islands' >Falkland Islands</option>
                                            <option value='Faroe Islands' >Faroe Islands</option><option value='Fiji' >Fiji</option>
                                            <option value='Finland' >Finland</option><option value='France' >France</option>
                                            <option value='French Guiana' >French Guiana</option><option value='French Polynesia' >French Polynesia</option>
                                            <option value='French Southern Territories' >French Southern Territories</option><option value='Gabon' >Gabon</option>
                                            <option value='Gambia' >Gambia</option><option value='Georgia' >Georgia</option>
                                            <option value='Germany' >Germany</option><option value='Ghana' >Ghana</option>
                                            <option value='Gibraltar' >Gibraltar</option><option value='Greece' >Greece</option>
                                            <option value='Greenland' >Greenland</option><option value='Grenada' >Grenada</option>
                                            <option value='Guadeloupe' >Guadeloupe</option><option value='Guam' >Guam</option>
                                            <option value='Guatemala' >Guatemala</option><option value='Guernsey' >Guernsey</option>
                                            <option value='Guinea' >Guinea</option><option value='Guinea-Bissau' >Guinea-Bissau</option>
                                            <option value='Guyana' >Guyana</option><option value='Haiti' >Haiti</option>
                                            <option value='Heard Island and McDonald Islands' >Heard Island and McDonald Islands</option>
                                            <option value='Holy See' >Holy See</option><option value='Honduras' >Honduras</option>
                                            <option value='Hong Kong' >Hong Kong</option><option value='Hungary' >Hungary</option>
                                            <option value='Iceland' >Iceland</option><option value='India' >India</option>
                                            <option value='Indonesia' >Indonesia</option><option value='Iran' >Iran</option>
                                            <option value='Iraq' >Iraq</option><option value='Ireland' >Ireland</option>
                                            <option value='Isle of Man' >Isle of Man</option><option value='Israel' >Israel</option>
                                            <option value='Italy' >Italy</option><option value='Jamaica' >Jamaica</option>
                                            <option value='Japan' >Japan</option><option value='Jersey' >Jersey</option>
                                            <option value='Jordan' >Jordan</option><option value='Kazakhstan' >Kazakhstan</option>
                                            <option value='Kenya' >Kenya</option><option value='Kiribati' >Kiribati</option>
                                            <option value='Korea, Democratic People&#039;s Republic of' >Korea, Democratic People&#039;s Republic of</option>
                                            <option value='Korea, Republic of' >Korea, Republic of</option><option value='Kuwait' >Kuwait</option>
                                            <option value='Kyrgyzstan' >Kyrgyzstan</option>
                                            <option value='Lao People&#039;s Democratic Republic' >Lao People&#039;s Democratic Republic</option>
                                            <option value='Latvia' >Latvia</option><option value='Lebanon' >Lebanon</option>
                                            <option value='Lesotho' >Lesotho</option><option value='Liberia' >Liberia</option>
                                            <option value='Libya' >Libya</option><option value='Liechtenstein' >Liechtenstein</option>
                                            <option value='Lithuania' >Lithuania</option><option value='Luxembourg' >Luxembourg</option>
                                            <option value='Macao' >Macao</option><option value='Madagascar' >Madagascar</option>
                                            <option value='Malawi' >Malawi</option><option value='Malaysia' >Malaysia</option>
                                            <option value='Maldives' >Maldives</option><option value='Mali' >Mali</option>
                                            <option value='Malta' >Malta</option><option value='Marshall Islands' >Marshall Islands</option>
                                            <option value='Martinique' >Martinique</option><option value='Mauritania' >Mauritania</option>
                                            <option value='Mauritius' >Mauritius</option><option value='Mayotte' >Mayotte</option>
                                            <option value='Mexico' >Mexico</option><option value='Micronesia' >Micronesia</option>
                                            <option value='Moldova' >Moldova</option><option value='Monaco' >Monaco</option>
                                            <option value='Mongolia' >Mongolia</option><option value='Montenegro' >Montenegro</option>
                                            <option value='Montserrat' >Montserrat</option><option value='Morocco' >Morocco</option>
                                            <option value='Mozambique' >Mozambique</option><option value='Myanmar' >Myanmar</option>
                                            <option value='Namibia' >Namibia</option><option value='Nauru' >Nauru</option>
                                            <option value='Nepal' >Nepal</option><option value='Netherlands' >Netherlands</option>
                                            <option value='New Caledonia' >New Caledonia</option><option value='New Zealand' >New Zealand</option>
                                            <option value='Nicaragua' >Nicaragua</option><option value='Niger' >Niger</option>
                                            <option value='Nigeria' >Nigeria</option><option value='Niue' >Niue</option>
                                            <option value='Norfolk Island' >Norfolk Island</option><option value='North Macedonia' >North Macedonia</option>
                                            <option value='Northern Mariana Islands' >Northern Mariana Islands</option><option value='Norway' >Norway</option>
                                            <option value='Oman' >Oman</option><option value='Pakistan' >Pakistan</option><option value='Palau' >Palau</option>
                                            <option value='Palestine, State of' >Palestine, State of</option><option value='Panama' >Panama</option>
                                            <option value='Papua New Guinea' >Papua New Guinea</option><option value='Paraguay' >Paraguay</option>
                                            <option value='Peru' >Peru</option><option value='Philippines' >Philippines</option>
                                            <option value='Pitcairn' >Pitcairn</option><option value='Poland' >Poland</option>
                                            <option value='Portugal' >Portugal</option><option value='Puerto Rico' >Puerto Rico</option>
                                            <option value='Qatar' >Qatar</option><option value='Romania' >Romania</option>
                                            <option value='Russian Federation' >Russian Federation</option><option value='Rwanda' >Rwanda</option>
                                            <option value='Réunion' >Réunion</option><option value='Saint Barthélemy' >Saint Barthélemy</option>
                                            <option value='Saint Helena, Ascension and Tristan da Cunha' >Saint Helena, Ascension and Tristan da Cunha</option>
                                            <option value='Saint Kitts and Nevis' >Saint Kitts and Nevis</option><option value='Saint Lucia' >Saint Lucia</option>
                                            <option value='Saint Martin' >Saint Martin</option>
                                            <option value='Saint Pierre and Miquelon' >Saint Pierre and Miquelon</option>
                                            <option value='Saint Vincent and the Grenadines' >Saint Vincent and the Grenadines</option>
                                            <option value='Samoa' >Samoa</option><option value='San Marino' >San Marino</option>
                                            <option value='Sao Tome and Principe' >Sao Tome and Principe</option><option value='Saudi Arabia' >Saudi Arabia</option>
                                            <option value='Senegal' >Senegal</option><option value='Serbia' >Serbia</option>
                                            <option value='Seychelles' >Seychelles</option><option value='Sierra Leone' >Sierra Leone</option>
                                            <option value='Singapore' >Singapore</option><option value='Sint Maarten' >Sint Maarten</option>
                                            <option value='Slovakia' >Slovakia</option><option value='Slovenia' >Slovenia</option>
                                            <option value='Solomon Islands' >Solomon Islands</option><option value='Somalia' >Somalia</option>
                                            <option value='South Africa' >South Africa</option>
                                            <option value='South Georgia and the South Sandwich Islands' >South Georgia and the South Sandwich Islands</option>
                                            <option value='South Sudan' >South Sudan</option><option value='Spain' >Spain</option>
                                            <option value='Sri Lanka' >Sri Lanka</option><option value='Sudan' >Sudan</option>
                                            <option value='Suriname' >Suriname</option><option value='Svalbard and Jan Mayen' >Svalbard and Jan Mayen</option>
                                            <option value='Sweden' >Sweden</option><option value='Switzerland' >Switzerland</option>
                                            <option value='Syria Arab Republic' >Syria Arab Republic</option><option value='Taiwan' >Taiwan</option>
                                            <option value='Tajikistan' >Tajikistan</option>
                                            <option value='Tanzania, the United Republic of' >Tanzania, the United Republic of</option>
                                            <option value='Thailand' >Thailand</option><option value='Timor-Leste' >Timor-Leste</option>
                                            <option value='Togo' >Togo</option><option value='Tokelau' >Tokelau</option>
                                            <option value='Tonga' >Tonga</option><option value='Trinidad and Tobago' >Trinidad and Tobago</option>
                                            <option value='Tunisia' >Tunisia</option><option value='Turkmenistan' >Turkmenistan</option>
                                            <option value='Turks and Caicos Islands' >Turks and Caicos Islands</option><option value='Tuvalu' >Tuvalu</option>
                                            <option value='Türkiye' >Türkiye</option><option value='US Minor Outlying Islands' >US Minor Outlying Islands</option>
                                            <option value='Uganda' >Uganda</option><option value='Ukraine' >Ukraine</option>
                                            <option value='United Arab Emirates' >United Arab Emirates</option>
                                            <option value='United Kingdom' >United Kingdom</option><option value='United States' >United States</option>
                                            <option value='Uruguay' >Uruguay</option><option value='Uzbekistan' >Uzbekistan</option>
                                            <option value='Vanuatu' >Vanuatu</option><option value='Venezuela' >Venezuela</option>
                                            <option value='Viet Nam' >Viet Nam</option><option value='Virgin Islands, British' >Virgin Islands, British</option>
                                            <option value='Virgin Islands, U.S.' >Virgin Islands, U.S.</option>
                                            <option value='Wallis and Futuna' >Wallis and Futuna</option><option value='Western Sahara' >Western Sahara</option>
                                            <option value='Yemen' >Yemen</option><option value='Zambia' >Zambia</option>
                                            <option value='Zimbabwe' >Zimbabwe</option><option value='Åland Islands' >Åland Islands</option>
                                            <!-- #endregion -->
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col me-2">
                                        <label for="plat_phone_no" class="form-label">Phone Number</label>
                                        <input type="text" class="form-control @error('plat_phone_no') is-invalid @enderror" id="plat_phone_no" name="plat_phone_no"
                                               placeholder="eg. +60198829640" value="{{ old('plat_phone_no') ?? $user->platinum->plat_phone_no }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col me-2">
                                        <label for="plat_fbname" class="form-label">Facebook Name</label>
                                        <input type="text" class="form-control @error('plat_fbname') is-invalid @enderror" id="plat_fbname" name="plat_fbname"
                                               placeholder="eg. John Doe" value="{{ old('plat_fbname') ?? $user->platinum->plat_fbname }}">
                                    </div>
                                </div>
                            @else
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="profile_name" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('profile_name') is-invalid @enderror" id="profile_name" name="profile_name"
                                               value="{{ old('profile_name') ?? $user->userProfile->profile_name }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col me-2">
                                        <label for="user_photo" class="form-label">Profile Photo</label>
                                        <input type="file" class="form-control @error('user_photo') is-invalid @enderror" id="user_photo" name="user_photo" accept="image/png,image/jpeg">
                                    </div>
                                    <div class="col">
                                        <img id="imagePreview" src="{{ Storage::url($user->userProfile->user_photo) }}" alt="Image" width="200" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col me-2">
                                        <label for="birth_date" class="form-label">Birth Date</label>
                                        <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date"
                                               value="{{ old('birth_date') ?? date('Y-m-d',strtotime($user->userProfile->birth_date)) }}">
                                    </div>
                                    <div class="col">
                                        <label for="phone_no" class="form-label">Phone No</label>
                                        <input type="text" class="form-control @error('phone_no') is-invalid @enderror" id="phone_no" name="phone_no"
                                               value="{{ old('phone_no') ?? $user->userProfile->phone_no }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                                               value="{{ old('address') ?? $user->userProfile->address }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="address2" class="form-label">Address 2</label>
                                        <input type="text" class="form-control @error('address2') is-invalid @enderror" id="address2" name="address2"
                                               value="{{ old('address2') ?? $user->userProfile->address2 }}">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-modern-layout>
