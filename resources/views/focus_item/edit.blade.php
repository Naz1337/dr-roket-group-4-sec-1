<x-modern-layout title="New Focus Item">
    @vite('resources/js/focus_item_create.js')
    <div class="card">
        <div class="card-body">
            <h3 class="mb-4">Edit Focus Item</h3>
            <form action="{{ route('focus-item.update', ['focusItem' => $focusItem, 'weeklyFocus' => $weeklyFocus]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="task" class="form-label">Task:</label>
                    <input type="text" name="task" class="form-control" id="task" value="{{ $focusItem->task }}">
                </div>
                <div>
                    <button class="btn btn-primary">Submit</button>
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
