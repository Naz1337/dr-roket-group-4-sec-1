@php
    use App\Enums\Roles;
@endphp
@section('scripts')
    <script type="module">
        $(document).ready(function () {
            let name = $("#name").val();
            let user_type = $("#user_type").val();
            let edu_level = $("#plat_cur_edu_level").val();
            let institute = $("#plat_institute").val();
            let batch = $("#plat_batch").val();
            let table = $('#profile-table').DataTable({
                "language": {
                    "processing": '<p class="text-center p-4"><i class="ti ti-refresh fa-spin"></i> Loading...</p>',
                },
                "layout": {
                    topStart: '',
                    topEnd: '',
                    bottomStart: 'info',
                    bottom2Start: 'pageLength'
                },
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('manage-user-profile') }}",
                    "type": "GET",
                    "data": function (d) {
                        d.name = name;
                        d.user_type = user_type;
                        d.edu_level = edu_level;
                        d.institute = institute;
                        d.batch = batch;
                    }
                },
                "columns": [
                    { "data": "name" },
                    { "data": "email" },
                    { "data": "user_type" },
                    { "data": "cur_level" },
                    { "data": "institute" },
                    { "data": "batch" },
                    { "data": "confirm" },
                    { "data": "id" }
                ],
                "columnDefs": [
                    {
                        "targets": 2, "render": function (data, type, row) {
                            let user = "";
                            switch(data) {
                                case {{ Config::get("constants.user.platinum") }} : user = "Platinum"; break;
                                case {{ Config::get("constants.user.crmp") }} : user = "CRMP"; break;
                                case {{ Config::get("constants.user.staff") }} : user = "Staff"; break;
                                case {{ Config::get("constants.user.mentor") }} : user = "Mentor"; break;
                            }
                            return '<div class="d-flex align-items-center gap-2"><span class="badge bg-primary rounded-3 fw-semibold">' + user + '</span></div>';
                        }
                    },
                    {
                        "targets": 6, "render": function(data, type, row) {
                            if (!data || data.trim() === '') {
                                return '';
                            }
                            const date = new Date(data);
                            const day = date.getDate();
                            const month = date.getMonth() + 1;
                            const year = date.getFullYear();
                            return day + '/' + month + '/' + year;
                        }
                    },
                    {
                        "targets": 7, "render": function (data, type, row) {
                            let route = "{{ route('view-profile',[]) }}/" + data;
                            return '<a href="' + route + '" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-title="View"><i class="ti ti-external-link"></i></a>';
                        }
                    }
                ]
            });

            $.ajaxSetup({
                // Disable caching of AJAX responses
                cache: false
            });

            $("#searchBtn").on("click", function() {
                name = $("#name").val();
                user_type = $("#user_type").val();
                edu_level = $("#plat_cur_edu_level").val();
                institute = $("#plat_institute").val();
                batch = $("#plat_batch").val();
                table.draw();
            });
            $('#exportExcelBtn').click(function(e) {
                e.preventDefault();

                // Get the values from the input fields
                var name = $('#name').val();
                var user_type = $('#user_type').val();
                var edu_level = $('#plat_cur_edu_level').val();
                var institute = $('#plat_institute').val();
                var batch = $('#plat_batch').val();

                // Construct the export URL with query parameters
                var exportUrl = "{{ route('generate-excel') }}?" +
                    "name=" + name +
                    "&user_type=" + user_type +
                    "&edu_level=" + edu_level +
                    "&institute=" + institute +
                    "&batch=" + batch;

                // Redirect to the export URL
                window.location.href = exportUrl;
            });
        });
    </script>
@stop
<x-modern-layout title="Manage Platinum">
    <div class="col d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title fw-semibold fs-8 mb-4">Your User Profile</h5>
                    </div>
                    <div class="col">
                        <a href="{{ route('edit-profile',Auth::user()->id) }}" class="btn btn-primary float-end">Edit Profile</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        @php
                            // Determine the user type
                            $isPlatOrCRMP = in_array(Auth::user()->user_type, Config::get('constants.user.platOrCRMP'));

                            // Choose the photo based on the user type
                            $photo = $isPlatOrCRMP ? Auth::user()->platinum->plat_photo : Auth::user()->userProfile->user_photo;

                            // Get the URL of the photo
                            $image_url = Storage::url($photo);

                            // if image_url is just '/storage/', then use '/assets/images/profile/user-1.jpg'
                            if ($image_url === '/storage/') {
                                $image_url = '/assets/images/profile/user-1.jpg';
                            }
                        @endphp
                        <img src="{{ $image_url }}" alt="#" class="card-img w-60 border border-3">
                    </div>
                    <div class="col-9">
                        @if(!in_array(Auth::user()->user_type, Config::get('constants.user.platOrCRMP')))
                            <div class="row">
                                <div class="col-2">
                                    <p class="fs-4 fw-bolder">Name</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ Auth::user()->userProfile->profile_name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <p class="fs-4 fw-bolder">Email</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ Auth::user()->userProfile->profile_email }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <p class="fs-4 fw-bolder">Birth Date</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ date('d/m/Y', strtotime(Auth::user()->userProfile->birth_date)) }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <p class="fs-4 fw-bolder">Phone No</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ Auth::user()->userProfile->phone_no }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <p class="fs-4 fw-bolder">Address</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ Auth::user()->userProfile->address }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <p class="fs-4 fw-bolder">Address 2</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ Auth::user()->userProfile->address2 }}</p>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-2">
                                    <p class="fs-4 fw-bolder">Title</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ Auth::user()->platinum->plat_title }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <p class="fs-4 fw-bolder">Name</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ Auth::user()->platinum->plat_name }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <p class="fs-4 fw-bolder">Gender</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ Auth::user()->platinum->plat_gender == 0 ? "Male" : "Female" }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <p class="fs-4 fw-bolder">Religion</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ Auth::user()->platinum->plat_religion }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <p class="fs-4 fw-bolder">Race</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ Auth::user()->platinum->plat_race }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <p class="fs-4 fw-bolder">Citizenship</p>
                                </div>
                                <div class="col">
                                    <p class="fs-4">{{ Auth::user()->platinum->plat_citizenship }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title fw-semibold fs-8 mb-4">Manage User Profile</h5>
                    </div>
{{--                    <div class="col">--}}
{{--                        <a href="{{route('add-platinum')}}" class="btn btn-primary m-1 float-end">Add Platinum</a>--}}
{{--                    </div>--}}
                </div>
                <p class="fw-semibold fs-6">Filter</p>
                <div class="row mb-4">
                    <div class="col">
                        <label for="name" class="control-label">Name</label>
                        <div class="col">
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>
                    @if(!in_array(Auth::user()->user_type, Config::get('constants.user.platOrCRMP')))
                        <div class="col-2">
                            <label for="user_type" class="control-label">User Type</label>
                            <div class="col">
                                <select name="user_type" id="user_type" class="form-select">
                                    <option value="">--- SELECT ---</option>
                                    <option value="{{ Roles::PLATINUM }}">Platinum</option>
                                    <option value="{{ Roles::STAFF }}">Staff</option>
                                    <option value="{{ Roles::MENTOR }}">Mentor</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="col">
                        <label for="plat_cur_edu_level" class="control-label">Education Level</label>
                        <div class="col">
                            <input type="text" name="plat_cur_edu_level" id="plat_cur_edu_level" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <label for="Institute" class="control-label">Institute</label>
                        <div class="col">
                            <input type="text" name="plat_institute" id="plat_institute" class="form-control">
                        </div>
                    </div>
                    <div class="col-1">
                        <label for="plat_batch" class="control-label">Batch</label>
                        <div class="col">
                            <input type="text" name="plat_batch" id="plat_batch" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button id="searchBtn" class="btn btn-primary float-end">Search</button>
                        @if(Auth::user()->user_type == Config::get('constants.user.staff'))
                            <a href="#" id="exportExcelBtn" class="btn btn-primary float-end me-2">Export Excel</a>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="table-responsive overflow-hidden">
                    <table class="table text-nowrap mb-0 align-middle" id="profile-table">
                        <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Email</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Type</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Education Level</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Institute</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Batch</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">App Confirm</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-modern-layout>
