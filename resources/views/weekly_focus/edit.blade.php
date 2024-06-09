<x-modern-layout title="Create New Weekly Focus">
    <div class="card">
        <div class="card-body">
            <h3 class="mb-4">Create New Weekly Focus</h3>
            <form action="{{ route('weekly-focus.update', ['weekly_focu' => $weeklyFocus]) }}" method="post">
                @csrf
                <div class="row mb-3">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-4 col-form-label">
                                <label for="startDate" class="form-label">Start Date:</label>
                            </div>

                            <div class="col">
                                <input type="date" name="start_date" class="form-control"
                                       id="startDate" value="{{ $weeklyFocus->start_date }}">
                            </div>

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-4 col-form-label">
                                <label class="form-label" for="endDate">End Date:</label>
                            </div>

                            <div class="col">
                                <input type="date" name="end_date" class="form-control"
                                       id="endDate" value="{{ $weeklyFocus->end_date }}">
                            </div>

                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <h4 class="mb-4">Focus Items</h4>

                    <div class="row">
                        <div class="col">
                            <div class="card shadow-md">
                                <div class="card-body">
                                    <h5 class="mb-3">Focus Block</h5>

                                    @foreach($weeklyFocus->focus_items->where('block_type', \App\Enums\BlockType::FOCUS) as $focusItem)
                                        <div class="row mb-3">
                                            <div class="col-2 col-form-label">
                                                <label for="focusItem{{ $loop->iteration }}">Focus Item {{ $loop->iteration }}:</label>
                                            </div>
                                            <div class="col d-flex align-items-center gap-3">
                                                <input type="text" name="focus_item[]" class="form-control-plaintext" readonly id="focusItem{{ $loop->iteration }}"
                                                       value="{{ $focusItem->task }}">
                                                <a href="{{ route('focus-item.edit', ['focusItem' => $focusItem, 'weeklyFocus' => $weeklyFocus]) }}"
                                                   class="btn btn-outline-primary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <form action="{{ route('focus-item.destroy', ['focusItem' => $focusItem]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger">
                                                        <i class="ti ti-x"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ route('focus-item.create', ['weeklyFocus' => $weeklyFocus, 'blockType' => \App\Enums\BlockType::FOCUS]) }}"
                                               class="btn btn-outline-success">
                                                New Focus
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow-md">
                                <div class="card-body">
                                    <h5 class="mb-3">Admin Block</h5>

                                    @foreach($weeklyFocus->focus_items->where('block_type', \App\Enums\BlockType::ADMIN) as $focusItem)
                                        <div class="row mb-3">
                                            <div class="col-2 col-form-label">
                                                <label for="focusItem{{ $loop->iteration }}">Admin Item {{ $loop->iteration }}:</label>
                                            </div>
                                            <div class="col d-flex align-items-center gap-3">
                                                <input type="text" name="focus_item[]" class="form-control-plaintext" readonly id="focusItem{{ $loop->iteration }}"
                                                       value="{{ $focusItem->task }}">
                                                <a href="{{ route('focus-item.edit', ['focusItem' => $focusItem, 'weeklyFocus' => $weeklyFocus]) }}"
                                                   class="btn btn-outline-primary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <form action="{{ route('focus-item.destroy', ['focusItem' => $focusItem]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger">
                                                        <i class="ti ti-x"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ route('focus-item.create', ['weeklyFocus' => $weeklyFocus, 'blockType' => \App\Enums\BlockType::ADMIN]) }}"
                                               class="btn btn-outline-success">
                                                New Admin
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow-md">
                                <div class="card-body">
                                    <h5 class="mb-3">Social Block</h5>

                                    @foreach($weeklyFocus->focus_items->where('block_type', \App\Enums\BlockType::SOCIAL) as $focusItem)
                                        <div class="row mb-3">
                                            <div class="col-2 col-form-label">
                                                <label for="focusItem{{ $loop->iteration }}">Social Item {{ $loop->iteration }}:</label>
                                            </div>
                                            <div class="col d-flex align-items-center gap-3">
                                                <input type="text" name="focus_item[]" class="form-control-plaintext" readonly id="focusItem{{ $loop->iteration }}"
                                                       value="{{ $focusItem->task }}">
                                                <a href="{{ route('focus-item.edit', ['focusItem' => $focusItem, 'weeklyFocus' => $weeklyFocus]) }}"
                                                   class="btn btn-outline-primary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <form action="{{ route('focus-item.destroy', ['focusItem' => $focusItem]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger">
                                                        <i class="ti ti-x"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ route('focus-item.create', ['weeklyFocus' => $weeklyFocus, 'blockType' => \App\Enums\BlockType::SOCIAL]) }}"
                                               class="btn btn-outline-success">
                                                New Social
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow-md">
                                <div class="card-body">
                                    <h5 class="mb-3">Recovery Block</h5>

                                    @foreach($weeklyFocus->focus_items->where('block_type', \App\Enums\BlockType::RECOVERY) as $focusItem)
                                        <div class="row mb-3">
                                            <div class="col-2 col-form-label">
                                                <label for="focusItem{{ $loop->iteration }}">Recovery Item {{ $loop->iteration }}:</label>
                                            </div>
                                            <div class="col d-flex align-items-center gap-3">
                                                <input type="text" name="focus_item[]" class="form-control-plaintext" readonly id="focusItem{{ $loop->iteration }}"
                                                       value="{{ $focusItem->task }}">
                                                <a href="{{ route('focus-item.edit', ['focusItem' => $focusItem, 'weeklyFocus' => $weeklyFocus]) }}"
                                                   class="btn btn-outline-primary">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <form action="{{ route('focus-item.destroy', ['focusItem' => $focusItem]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger">
                                                        <i class="ti ti-x"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row">
                                        <div class="col">
                                            <a href="{{ route('focus-item.create', ['weeklyFocus' => $weeklyFocus, 'blockType' => \App\Enums\BlockType::RECOVERY]) }}"
                                               class="btn btn-outline-success">
                                                New Recovery
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <a href="{{ route('weekly-focus.show', ['weekly_focu' => $weeklyFocus]) }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-outline-primary">Edit</button>
                </div>

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
