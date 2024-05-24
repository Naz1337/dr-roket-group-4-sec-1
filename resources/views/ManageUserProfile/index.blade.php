<x-modern-layout title="Manage Platinum">
    <div class="col d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title fw-semibold mb-4">Platinums</h5>
                    </div>
{{--                    <div class="col">--}}
{{--                        <a href="{{route('add-platinum')}}" class="btn btn-primary m-1 float-end">Add Platinum</a>--}}
{{--                    </div>--}}
                </div>
                @section('scripts')
                    <script type="module">
                        $(document).ready(function () {
                            $("#platinum-table").DataTable({

                            });
                        })
                    </script>
                @stop
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle" id="platinum-table">
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
                        <tbody>
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="mb-1">Sunil Joshi</h6>
{{--                                <span class="fw-normal">Web Designer</span>--}}
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">suniljoshi@gmail.com</p>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-primary rounded-3">Platinum Premier</span>
                                </div>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-0">Software Engineering</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-0">Universiti Malaysia Pahang</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-0">4</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="mb-0">11/11/2023</h6>
                            </td>
                            <td class="border-bottom-0">
                                <a href="#" class="btn btn-outline-dark" data-bs-toggle="tooltip" data-bs-title="View"><i class="ti ti-external-link"></i></a>
                                <a href="#" class="btn btn-outline-warning" data-bs-toggle="tooltip" data-bs-title="Edit"><i class="ti ti-edit"></i></a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-modern-layout>
