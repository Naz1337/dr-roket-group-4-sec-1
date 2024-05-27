@section('scripts')
    <script type="module">
        $(document).ready(function () {
            $("#imagePreview").hide();
            $('#other_discover').hide();
            $("#referralInfo").hide();
            $("#plat_photo").on("change",function(e){
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
        })
    </script>
@stop
<x-modern-layout title="Add Platinum">
    <div class="container-fluid">
        @if(session('error'))
            <div class="alert alert-{{ session('error-type') ? session('error-type') : 'warning' }} alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-bolder fs-8 mb-4">Add Platinum</h5>
                <form action="{{ route('register-platinum-post') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title fw-bolder fs-7 mb-4">Personal Info</h4>
                            <div class="row mb-3">
                                <div class="col-2 me-2">
                                    <label for="plat_title" class="form-label">Title</label>
                                    <input type="text" class="form-control @error('plat_title') is-invalid @enderror" id="plat_title" name="plat_title"
                                           placeholder="eg. Dr." value="{{ old('plat_title') }}">
                                </div>
                                <div class="col">
                                    <label for="plat_name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('plat_name') is-invalid @enderror" id="plat_name" name="plat_name"
                                           placeholder="eg. John Doe" value="{{ old('plat_name') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat_ic" class="form-label">Identity Card No.</label>
                                    <input type="text" class="form-control @error('plat_ic') is-invalid @enderror" id="plat_ic" name="plat_ic"
                                           placeholder="eg. 020304123256" value="{{ old('plat_ic') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="plat_gender" class="form-label @error('plat_gender') text-danger @enderror">Gender</label>
                                <div class="col">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="plat_gender" id="plat_gender" value="0" checked>
                                        <label class="form-check-label" for="plat_gender">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="plat_gender" id="plat_gender" value="1">
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
                                    <img id="imagePreview" src="#" alt="Image" width="200" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col me-2">
                                    <label for="plat_religion" class="form-label">Religion</label>
                                    <input type="text" class="form-control @error('plat_religion') is-invalid @enderror" id="plat_religion" name="plat_religion"
                                           placeholder="eg. Muslim" value="{{ old('plat_religion') }}">
                                </div>
                                <div class="col">
                                    <label for="plat_race" class="form-label">Race</label>
                                    <input type="text" class="form-control @error('plat_race') is-invalid @enderror" id="plat_race" name="plat_race"
                                           placeholder="eg. Malay" value="{{ old('plat_race') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat_citizenship" class="form-label">Citizenship</label>
                                    <input type="text" class="form-control @error('plat_citizenship') is-invalid @enderror" id="plat_citizenship" name="plat_citizenship"
                                           placeholder="Malaysia" value="{{ old('plat_citizenship') }}">
                                </div>
                            </div>
                            <hr>
                            <h4 class="card-title fw-bolder fs-7 mb-4">Contact Info</h4>
                            <div class="row mb-3">
                                <div class="col me-2">
                                    <label for="plat_address" class="form-label">Address</label>
                                    <input type="text" class="form-control @error('plat_address') is-invalid @enderror" id="plat_address" name="plat_address"
                                           placeholder="eg. 123 Building" value="{{ old('plat_address') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat_address2" class="form-label">Address 2</label>
                                    <input type="text" class="form-control @error('plat_address2') is-invalid @enderror" id="plat_address2" name="plat_address2"
                                           value="{{ old('plat_address2') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col me-2">
                                    <label for="plat_city" class="form-label">City</label>
                                    <input type="text" class="form-control @error('plat_city') is-invalid @enderror" id="plat_city" name="plat_city"
                                           placeholder="eg. Kota Kinabalu" value="{{ old('plat_city') }}">
                                </div>
                                <div class="col  me-2">
                                    <label for="plat_state" class="form-label">State</label>
                                    <input type="text" class="form-control @error('plat_state') is-invalid @enderror" id="plat_state" name="plat_state"
                                           placeholder="e.g Sabah" value="{{ old('plat_state') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col me-2">
                                    <label for="plat_postcode" class="form-label">Postcode/ ZIP Code/ Postal Code</label>
                                    <input type="text" class="form-control @error('plat_postcode') is-invalid @enderror" id="plat_postcode" name="plat_postcode"
                                           placeholder="e.g Sabah" value="{{ old('plat_postcode') }}">
                                </div>
                                <div class="col">
                                    <label for="plat_country" class="form-label @error('plat_country') text-danger @enderror">Country</label>
                                    <select name="plat_country" id="plat_country" class="form-select">
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
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col me-2">
                                    <label for="plat_phone_no" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control @error('plat_phone_no') is-invalid @enderror" id="plat_phone_no" name="plat_phone_no"
                                           placeholder="eg. +60198829640" value="{{ old('plat_phone_no') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat_email" class="form-label">Email</label>
                                    <input type="text" class="form-control @error('plat_email') is-invalid @enderror" id="plat_email" name="plat_email"
                                           placeholder="eg. johndoe@email.com" value="{{ old('plat_email') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col me-2">
                                    <label for="plat_fbname" class="form-label">Facebook Name</label>
                                    <input type="text" class="form-control @error('plat_fbname') is-invalid @enderror" id="plat_fbname" name="plat_fbname"
                                           placeholder="eg. John Doe" value="{{ old('plat_fbname') }}">
                                </div>
                            </div>
                            <hr>
                            <h4 class="card-title fw-bolder fs-7 mb-4">Education Info</h4>
                            <div class="row mb-3">
                                <div class="col me-2">
                                    <label for="plat_cur_edu_field" class="form-label">Current Education Field</label>
                                    <input type="text" class="form-control @error('plat_cur_edu_field') is-invalid @enderror" id="plat_cur_edu_field" name="plat_cur_edu_field"
                                           placeholder="eg. Muslim" value="{{ old('plat_cur_edu_field') }}">
                                </div>
                                <div class="col">
                                    <label for="plat_race" class="form-label">Education Field</label>
                                    <input type="text" class="form-control @error('plat_race') is-invalid @enderror" id="plat_edu_field" name="plat_edu_field"
                                           placeholder="eg. Malay" value="{{ old('plat_race') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat_edu_institute" class="form-label">Education Institute</label>
                                    <input type="text" class="form-control @error('plat_edu_institute') is-invalid @enderror" id="plat_edu_institute" name="plat_edu_institute"
                                           placeholder="eg. University Malaysia Pahang" value="{{ old('plat_edu_institute') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat_occupation" class="form-label">Occupation</label>
                                    <input type="text" class="form-control @error('plat_occupation') is-invalid @enderror" id="plat_occupation" name="plat_occupation"
                                           placeholder="eg. Lecturer" value="{{ old('plat_occupation') }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat_study_sponsor" class="form-label">Study Sponsor</label>
                                    <input type="text" class="form-control @error('plat_study_sponsor') is-invalid @enderror" id="plat_study_sponsor" name="plat_study_sponsor"
                                           placeholder="eg. Dr Roket" value="{{ old('plat_study_sponsor') }}">
                                </div>
                            </div>
                            <hr>
                            <h4 class="card-title fw-bolder fs-7 mb-4">Program Info</h4>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat_discover_type" class="form-label @error('plat_discover_type') text-danger @enderror">How did you discover us?</label>
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
                            <div class="row mb-3" id="other_discover">
                                <div class="col">
                                    <label for="plat_discover_type_others" class="form-label @error('plat_discover_type_others') text-danger @enderror">Other type of Discover</label>
                                    <input type="text" class="form-control" id="plat_discover_type_others" name="plat_discover_type_others">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="plat_prog_interest" class="form-label @error('plat_prog_interest') text-danger @enderror">Program Interested</label>
                                <div class="col">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="plat_prog_interest" id="plat_prog_interest" value="{{Config::get('constants.program.plat_professorship')}}" checked>
                                        <label class="form-check-label" for="plat_prog_interest">Platinum Professorship</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="plat_prog_interest" id="plat_prog_interest" value="{{Config::get('constants.program.plat_premier')}}">
                                        <label class="form-check-label" for="plat_prog_interest">Platinum Premier</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="plat_prog_interest" id="plat_prog_interest" value="{{Config::get('constants.program.plat_elite')}}">
                                        <label class="form-check-label" for="plat_prog_interest">Platinum Elite</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="plat_prog_interest" id="plat_prog_interest" value="{{Config::get('constants.program.plat_drjr')}}">
                                        <label class="form-check-label" for="plat_prog_interest">Platinum Dr. Jr.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat_batch" class="form-label @error('plat_batch') text-danger @enderror">Batch</label>
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
                            <hr>
                            <h4 class="card-title fw-bolder fs-7 mb-4">Register Confirmation</h4>
                            <div class="row mb-3">
                                <label for="plat_has_referral" class="form-label @error('plat_has_referral') text-danger @enderror">Do you have a referral?</label>
                                <div class="col">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="plat_has_referral" id="plat_has_referral" value="0" checked>
                                        <label class="form-check-label" for="plat_has_referral">No</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="plat_has_referral" id="plat_has_referral" value="1">
                                        <label class="form-check-label" for="plat_has_referral">Yes</label>
                                    </div>
                                </div>
                            </div>
                            <div id="referralInfo">
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="plat_referral_name" class="form-label">Other type of Discover</label>
                                        <input type="text" class="form-control" id="plat_referral_name" name="plat_referral_name">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <label for="plat_referral_batch" class="form-label ">Other type of Discover</label>
                                        <input type="text" class="form-control" id="plat_referral_batch" name="plat_referral_batch">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="plat_tshirt" class="form-label @error('plat_tshirt') text-danger @enderror">Do you have a referral?</label>
                                <div class="col">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="plat_tshirt" id="plat_tshirt" value="0" checked>
                                        <label class="form-check-label" for="plat_tshirt">XS</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="plat_tshirt" id="plat_tshirt" value="1">
                                        <label class="form-check-label" for="plat_tshirt">S</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="plat_tshirt" id="plat_tshirt" value="2">
                                        <label class="form-check-label" for="plat_tshirt">2XL</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" name="plat_tshirt" id="plat_tshirt" value="3">
                                        <label class="form-check-label" for="plat_tshirt">3XL</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="plat_app_confirm" class="form-label @error('plat_app_confirm') text-danger @enderror">Consent</label>
                                <div class="col">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" name="plat_app_confirm" id="plat_app_confirm" value="true">
                                        <label class="form-check-label" for="plat_app_confirm">I hereby confirm that the details I have filled on this application are true and valid.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat_app_confirm_date" class="form-label @error('plat_app_confirm_date') text-danger @enderror">Date of Application</label>
                                    <input type="date" class="form-control" id="plat_app_confirm_date" name="plat_app_confirm_date">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="plat_payment_type" class="form-label @error('plat_payment_type') text-danger @enderror">Payment Type</label>
                                <div class="col">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="plat_payment_type" id="plat_payment_type" value="0" checked>
                                        <label class="form-check-label" for="plat_payment_type">FPX / Credit Card / Debit Card</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="plat_payment_type" id="plat_payment_type" value="1">
                                        <label class="form-check-label" for="plat_payment_type">FPX - Referral</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="plat_payment_type" id="plat_payment_type" value="2">
                                        <label class="form-check-label" for="plat_payment_type">Direct Transfer / Payment</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="plat_payment_proof" class="form-label">Payment Proof</label>
                                    <input type="file" class="form-control @error('plat_payment_proof') is-invalid @enderror"
                                           id="plat_payment_proof" name="plat_payment_proof" accept="image/png,image/jpeg,application/pdf">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-modern-layout>
