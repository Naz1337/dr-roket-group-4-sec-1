<x-modern-layout title="New Focus Item">
    @vite('resources/js/focus_item_create.js')
    <div class="card">
        <div class="card-body">
            <h3 class="mb-4">Create New Focus Item</h3>
            <form action="{{ route('focus-item.store', ['weeklyFocus' => $weeklyFocus]) }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="task" class="form-label">Task:</label>
                    <input type="text" name="task" class="form-control" id="task">
                </div>
                <div>
                    <button class="btn btn-primary">Submit</button>
                </div>
                <input type="hidden" name="block_type" value="{{ request()->input('blockType') }}">
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
