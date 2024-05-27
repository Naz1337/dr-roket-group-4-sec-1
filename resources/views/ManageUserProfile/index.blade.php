@section('scripts')
    <script type="module">
        $(document).ready(function () {
            $('#profile-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('manage-user-profile') }}",
                    "type": "GET"
                },
                "columns": [
                    { "data": "name" },
                    { "data": "email" },
                    { "data": "user_type" },
                    { "data": "cur_field" },
                    { "data": "institute" },
                    { "data": "batch" },
                    { "data": "confirm" },
                    { "data": "id" }
                ],
                "columnDefs": [
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
                    }
                ]
            });
        })
    </script>
@stop
<x-modern-layout title="Manage Platinum">
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
                <hr>
                <div class="table-responsive">
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
                                <h6 class="fw-semibold mb-0">Current Field</h6>
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
