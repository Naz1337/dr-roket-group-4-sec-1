<x-modern-layout title="View Profile">
    <div class="container-fluid">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title fw-semibold fs-8 mb-4">User Profile</h5>
                            </div>
                            <div class="col">
                                @if(Auth::user()->id == $user->id)
                                    <a href="{{ route('edit-profile',Auth::user()->id) }}" class="btn btn-primary float-end">Edit Profile</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        @php
                            $isPlatOrCRMP = in_array($user->user_type, Config::get('constants.user.platOrCRMP'));
                            $photoPath = $isPlatOrCRMP ? $user->platinum->plat_photo : $user->userProfile->user_photo;
                            $storageUrl = Storage::url($photoPath);
                            $place = $storageUrl == '/storage/' ? '/assets/images/profile/user-1.jpg' : $storageUrl;
                        @endphp
                        <img src="{{ $place }}" alt="#" class="card-img w-60 border border-3">
                    </div>
                    <div class="col-9">
                        @if(!in_array($user->user_type, Config::get('constants.user.platOrCRMP')))
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Name</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->userProfile->profile_name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Email</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->userProfile->profile_email }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Birth Date</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ date('d/m/Y', strtotime($user->userProfile->birth_date)) }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Phone No</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->userProfile->phone_no }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Address</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->userProfile->address }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Address 2</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->userProfile->address2 }}</p>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Title</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_title }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Name</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Identity Card No.</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_ic }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Gender</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_gender == 0 ? "Male" : "Female" }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Religion</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_religion }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Race</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_race }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Citizenship</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_citizenship }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                @if(in_array($user->user_type, Config::get('constants.user.platOrCRMP')))
                    <hr>
                    <h5 class="card-title fw-semibold fs-8 mb-4">Contact Information</h5>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Address</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_address }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Address 2</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_address2 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">City</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_city }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">State</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_state }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Postcode</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_postcode }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Country</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_country }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Phone Number</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_phone_no }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Email</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Facebook Name</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_fbname }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col"></div>
                    </div>
                    <hr>
                    <h5 class="card-title fw-semibold fs-8 mb-4">Education Information</h5>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Current Education Level</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_cur_edu_level }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Education Field</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_edu_field }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Education Institute</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_edu_institute }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Occupation</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_occupation }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Study Sponsor</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_study_sponsor }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Discover Type</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_discover_type }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Program Interest</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">
                                        @php
                                            echo match($user->platinum->plat_prog_interest) {
                                                Config::get('constants.program.plat_professorship') => "Platinum Professorship",
                                                Config::get('constants.program.plat_premier') => "Platinum Premier",
                                                Config::get('constants.program.plat_elite') => "Platinum Elite",
                                                Config::get('constants.program.plat_drjr') => "Platinum Dr. Jr."
                                            }
                                        @endphp
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Batch</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_batch }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5 class="card-title fw-semibold fs-8 mb-4">Program Information</h5>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Has Referral</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_has_referral == 1 ? "True" : "False" }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Referral Name</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_referral_name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Referral Batch</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_referral_batch }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">T-Shirt</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_tshirt }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Application Confirmed</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ $user->platinum->plat_app_confirm ? 'Yes' : 'No' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Confirmation Date</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ date('d/m/Y',strtotime($user->platinum->plat_app_confirm_date)) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <p class="fs-4 fw-bolder">Payment Type</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">
                                        @php
                                            echo match($user->platinum->plat_payment_type) {
                                                Config::get('constants.payment.FPX/Credit Card/Debit Card') => "FPX/Credit Card/Debit Card",
                                                Config::get('constants.payment.FPX-Referral') => "FPX-Referral",
                                                Config::get('constants.payment.Direct Transfer/Payment') => "Direct Transfer/Payment"
                                            }
                                        @endphp
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <a href="{{ route('manage-user-profile') }}" class="btn btn-primary float-end mb-4">Back to Manage User Profile</a>
    </div>
</x-modern-layout>
