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
                    <h4 class="mb-3">Focus Item</h4>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow-md">
                                <div class="card-body">
                                    <h5 class="mb-3">Focus Block</h5>
                                    <div class="row mb-4">
                                        <div class="col-2 col-form-label">
                                            <label for="focus">Number of Item:</label>
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
                </div>
{{--                <div class="mb-3">--}}
{{--                    <label for="focus" class="form-label">Focus</label>--}}
{{--                    <textarea name="focus" id="focus" class="form-control" rows="5"></textarea>--}}
{{--                </div>--}}
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</x-modern-layout>
