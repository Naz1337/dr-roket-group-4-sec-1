<x-modern-layout title="Create New Weekly Focus">
    @vite('resources/js/focus_create.js')
    <div class="card">
        <div class="card-body">
            <h3 class="mb-4">Create New Weekly Focus</h3>
            <form action="{{ route('weekly-focus.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-4 col-form-label">
                                <label for="startDate" class="form-label">Start Date:</label>
                            </div>

                            <div class="col">
                                <input type="date" name="start_date" class="form-control" id="startDate">
                            </div>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-4 col-form-label">
                                <label class="form-label" for="endDate">End Date:</label>
                            </div>

                            <div class="col">
                                <input type="date" name="end_date" class="form-control" id="endDate">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <h4 class="mb-4">Focus Items</h4>
                    <div class="row mb-3">
                        <div class="col-2 col-form-label">
                            <label for="focus">Number of Focus:</label>
                        </div>
                        <div class="col-3">
                            <select id="focus" class="form-select">
                                <option value="" selected disabled>Choose a Number</option>
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2 col-form-label">
                            <label for="admin">Number of Admin:</label>
                        </div>
                        <div class="col-3">
                            <select id="admin" class="form-select">
                                <option value="" selected disabled>Choose a Number</option>
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2 col-form-label">
                            <label for="social">Number of Social:</label>
                        </div>
                        <div class="col-3">
                            <select id="social" class="form-select">
                                <option value="" selected disabled>Choose a Number</option>
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-2 col-form-label">
                            <label for="recovery">Number of Recovery:</label>
                        </div>
                        <div class="col-3">
                            <select id="recovery" class="form-select">
                                <option value="" selected disabled>Choose a Number</option>
                                @for($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="card shadow-md">
                                <div class="card-body">
                                    <h5 class="mb-3">Focus Block</h5>

                                    @php
                                    $numberOfFocusItem = request()->input('focus') ?? 0;
                                    // if numberOfFocusItem is string, convert it to int
                                    $numberOfFocusItem = is_string($numberOfFocusItem) ? (int)$numberOfFocusItem : $numberOfFocusItem;
                                    @endphp
                                    @for($i = 1; $i <= $numberOfFocusItem; $i++)
                                        <div class="row mb-3">
                                            <div class="col-2 col-form-label">
                                                <label for="focusItem{{ $i }}">Focus Item {{ $i }}:</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="focus_item[]" class="form-control" id="focusItem{{ $i }}">
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow-md">
                                <div class="card-body">
                                    <h5 class="mb-3">Admin Block</h5>

                                    @php
                                        $numberOfAdminItem = request()->input('admin') ?? 0;
                                        // if numberOfFocusItem is string, convert it to int
                                        $numberOfAdminItem = is_string($numberOfAdminItem) ? (int)$numberOfAdminItem : $numberOfAdminItem;
                                    @endphp
                                    @for($i = 1; $i <= $numberOfAdminItem; $i++)
                                        <div class="row mb-3">
                                            <div class="col-2 col-form-label">
                                                <label for="adminItem{{ $i }}">Admin Item {{ $i }}:</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="admin_item[]" class="form-control" id="adminItem{{ $i }}">
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow-md">
                                <div class="card-body">
                                    <h5 class="mb-3">Social Block</h5>

                                    @php
                                        $numberOfSocialItem = request()->input('social') ?? 0;
                                        // if numberOfFocusItem is string, convert it to int
                                        $numberOfSocialItem = is_string($numberOfSocialItem) ? (int)$numberOfSocialItem : $numberOfSocialItem;
                                    @endphp
                                    @for($i = 1; $i <= $numberOfSocialItem; $i++)
                                        <div class="row mb-3">
                                            <div class="col-2 col-form-label">
                                                <label for="socialItem{{ $i }}">Social Item {{ $i }}:</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="social_item[]" class="form-control" id="socialItem{{ $i }}">
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow-md">
                                <div class="card-body">
                                    <h5 class="mb-3">Recovery Block</h5>

                                    @php
                                        $numberOfRecoveryItem = request()->input('social') ?? 0;
                                        // if numberOfFocusItem is string, convert it to int
                                        $numberOfRecoveryItem = is_string($numberOfRecoveryItem) ? (int)$numberOfRecoveryItem : $numberOfRecoveryItem;
                                    @endphp
                                    @for($i = 1; $i <= $numberOfRecoveryItem; $i++)
                                        <div class="row mb-3">
                                            <div class="col-2 col-form-label">
                                                <label for="recoveryItem{{ $i }}">Recovery Item {{ $i }}:</label>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="recovery_item[]" class="form-control" id="recoveryItem{{ $i }}">
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-modern-layout>
