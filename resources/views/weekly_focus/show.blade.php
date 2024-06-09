<x-modern-layout title="Weekly Focus {{ $weeklyFocus->start_date }} - {{ $weeklyFocus->end_date }}">
    <div class="card">
        <div class="card-body">
            <h3 class="mb-4">View Weekly Focus</h3>
            <div class="row mb-4">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6 col-form-label">
                            <div class="form-label">Start Date: </div>
                        </div>
                        <div class="col-6">
                            <div class="form-control-plaintext">
                                {{ $weeklyFocus->start_date }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6 col-form-label">
                            <div class="form-label">End Date: </div>
                        </div>
                        <div class="col-6">
                            <div class="form-control-plaintext">
                                {{ $weeklyFocus->end_date }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <h4 class="mb-4">Focus Items</h4>
                <div class="mb-4">
                    <h5 class="mb-3">Focus Block</h5>
                    <div class="row">
                        <div class="col">
                            <ul class="list-group list-group-numbered" style="max-width: 25rem">
                                @foreach($weeklyFocus->focus_items->where('block_type', \App\Enums\BlockType::FOCUS) as $focusItem)
                                    <li class="list-group-item p-2">{{ $focusItem->task }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <h5 class="mb-3">Admin Block</h5>
                    <div class="row">
                        <div class="col">
                            <ul class="list-group list-group-numbered" style="max-width: 25rem">
                                @foreach($weeklyFocus->focus_items->where('block_type', \App\Enums\BlockType::ADMIN) as $focusItem)
                                    <li class="list-group-item p-2">{{ $focusItem->task }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <h5 class="mb-3">Social Block</h5>
                    <div class="row">
                        <div class="col">
                            <ul class="list-group list-group-numbered" style="max-width: 25rem">
                                @foreach($weeklyFocus->focus_items->where('block_type', \App\Enums\BlockType::SOCIAL) as $focusItem)
                                    <li class="list-group-item p-2">{{ $focusItem->task }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <h5 class="mb-3">Recovery Block</h5>
                    <div class="row">
                        <div class="col">
                            <ul class="list-group list-group-numbered" style="max-width: 25rem">
                                @foreach($weeklyFocus->focus_items->where('block_type', \App\Enums\BlockType::RECOVERY) as $focusItem)
                                    <li class="list-group-item p-2">{{ $focusItem->task }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-3">
                <a class="btn btn-secondary" href="{{ route('weekly-focus.edit', ['weekly_focu' => $weeklyFocus]) }}">Edit</a>
                <form action="{{ route('weekly-focus.destroy', ['weekly_focu' => $weeklyFocus]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</x-modern-layout>
